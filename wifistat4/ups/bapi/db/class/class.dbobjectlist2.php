<?
/*---------------------------------------------------------------------------
		File		: class.mysql_dbobjectlist.php
		Desc		:	Implements a list of CDBObject
							Basically same functions as in CDBObject, reorganized
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 6-oct-2004
		Created : 6-oct-2004
		Version : 2
		Updates : 
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 25-may-2005
		Version : 1.16
		Desc		: (+) Query()
							(+) affected rows
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 13-aug-2005
		Version : 1.16
		Desc		: (+) stopcount
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 21-oct-2005
		Version : 1.17
		Desc		: (~) fixed count error for queries with group by
---------------------------------------------------------------------------*/

class CDBObjectList2 extends CDBObject
{
	var $items;													// array of CDBOject or CDBOject derived objexts
	var $itemscount;										// count of the items array
	
	
	var $orderby;												// order by expresion
	var $groupby;												// group by expresion
	var $filter;												// filter (where expresion)
	var $customfilter;									// custom filter added to the internally generated filters, use from controler
	
	var $start;													// limit start
	var $count;													// limit count
	var $distinct;
	var $systemfilter;									// used internally
	var $extendsfilter;									// when extending, use this filter
	
	var $stopcount = 0;									// number of items to stop fetching after... useful to use instead of count when you are filtering in dbobject::DB_FetchFromArray
	var $overwriteclone = 1; 						// when creating an objects list... should we overwrite with our own fields?
	
	
	// used by DB_GetObjectsWH_J
	var $jrccount;
	var $jctables;
	
	function GetSelectList($caption,$captionindex=0)
	{
		$rv = array();
		for($i=0;$i<count($this->items);$i++)
			if(!$captionindex)
				$rv[$this->items[$i]->ident] = eval('return $this->items[$i]->'.$caption.';');
			else
			{
				$val = eval('return $this->items[$i]->'.$caption.';');
				$rv[$val] = $val;
			}
			
		return $rv;
	}

	function DB_GetObjectsWH($justcount=0)
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;
		$items = array();
		if($this->distinct) $dist = "distinct";
		if(!$justcount)
		{
			if((USEDBENGINE=="MSSQL")&&($this->count)) $top = "TOP ".($this->count+$this->start);
			else $top = "";
			$query = "select ".$dist." ".$top." ".$this->DB_GetFieldsList()." from $selectfrom $this->_addtables $this->addtables where (1=1) ";
			if($this->filter!="") 			$query.=" and ($this->filter)";
			if($this->systemfilter!="") 			$query.=" and ($this->systemfilter)";
			if($this->extendsfilter!="") 			$query.=" and ($this->extendsfilter)";
			if($this->customfilter!="") $query.=" and ($this->customfilter)";
			
			
			if($this->groupby!="") 
				$query.=" group by ".str_replace("<all>",$this->DB_GetPhyFieldsList(),$this->groupby);
			if($this->orderby!="") $query.=" order by $this->orderby ";
			
			if($this->count) 
			{
				if(USEDBENGINE=="MYSQL") $query.=" limit $this->start,$this->count";
				elseif(USEDBENGINE=="POSTGRESQL") $query.= " limit $this->count offset $this->start";
			}
			$result = $this->Query($query);
			if((USEDBENGINE=="MSSQL")&&($this->start)) b_data_seek($result,$this->start);
			
			$numrows = b_num_rows($result);
			if($this->count)
				if($this->count<b_num_rows($result)) $numrows = $this->count;
			
			for($i=0;$i<$numrows;$i++)
			{
				$dbline = b_fetch_row($result);
				$obj =  GetDBObject($this->tablename,$this->tbl_prefix);
				if($this->overwriteclone)
				{
					$obj->fields = $this->fields;
					$obj->expresions = $this->expresions;
					$obj->phyfiecount = $this->phyfiecount;	
					$obj->fieldscount = $this->fieldscount;
				}
				
				//$this->items[$i]->DB_FetchFromArray($dbline);
				if($obj->DB_FetchFromArray($dbline)) 
				{
					$this->items[] = $obj;
					if((count($this->items)>=$this->stopcount)&&($this->stopcount)) break;
				}
			}
			$this->itemscount = count($this->items);
			//echo $this->query;
			return $this->items;
		}
		else
		{
			
			if($this->groupby=="")
				$query = "select count($dist ".$selectfrom.".ident) from $selectfrom $this->_addtables $this->addtables where (1=1) ";
			else
				$query = "select 1 from $selectfrom $this->_addtables $this->addtables where (1=1) ";
			if($this->filter!="") 			$query.=" and ($this->filter)";
			if($this->extendsfilter!="") 			$query.=" and ($this->extendsfilter)";
			if($this->systemfilter!="") 			$query.=" and ($this->systemfilter)";
			if($this->customfilter!="") $query.=" and ($this->customfilter)";
			if($this->groupby!="") 
			{
				$query.=" group by ".str_replace("<all>",$this->DB_GetPhyFieldsList(),$this->groupby);
				$query = "select count(*) from (".$query.") as auxq";
			}
			$this->itemscount = b_quick_value($query);
			
			return $this->itemscount;
		}
	}	

	function DB_GetObjectsFilter($justcount=0)
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;
		$this->filter = "(1=1) ";
		for($i=0;$i<$this->fieldscount;$i++)
		{
						
			$fv = eval('return $this->'.$this->fields[$i].';');
			if(is_array($fv))
			{
				
				$whitem = " (1=1) ";
				$fieldname = $this->fields[$i];
				if(array_key_exists($fieldname,$this->expresions)) $fieldname = "(".$this->expresions[$fieldname].")";
				else $fieldname = $selectfrom.".".$fieldname;
				if($fv['type']=="mc")
				{
					$whitem = $this->HTTP_TranslateMS($fv['value'],$this->fields[$i]);
					$whitem = "(".$this->fields[$i]." LIKE '".$whitem."')";
				}
				elseif($fv['type']=="rc")
				{
						$whitem = "((1=0) ";
						for($j=0;$j<count($fv['value']);$j++)
							if($fv['value'][$j]!="")				
								$whitem.=" or (".$fieldname."='".$fv['value'][$j]."')";
						$whitem.=")";
				}
				elseif($fv['type']=="value")
				{
					if(($fv['value']!=$this->delim)&&(($fv['value']!="")))
						$whitem="(".$fieldname."='".$fv['value']."')";
					if((is_numeric($fv['value']))&&($fv['value']==0)) $whitem = " (1=1) ";
				}
				elseif($fv['type']=="like")
				{
					if(($fv['value']!=$this->delim)&&($fv['value']!=""))
					{
						$fv['value'] = str_replace(" ","%",$fv['value']);
						$whitem="(".$fieldname." LIKE '%".$fv['value']."%')";
					}
				}
				elseif($fv['type']=="not")
				{
					if(($fv['value']!=$this->delim)&&(($fv['value']!=0)))
						$whitem="(".$fieldname."<>'".$fv['compare']."')";
				}
				elseif($fv['type']=="range")
				{
						if(!$fv['ignore'])
						{
							$min = "(".$fieldname.">='".$fv['min']."')";
							$max = "(".$fieldname."<='".$fv['max']."')";
							if((!$fv['min'])&&(!($fv['min']==="0"))) $min = "1=1";
							if((!$fv['max'])&&(!($fv['min']==="0"))) $max = "1=1";
							$whitem="((($min) and ($max)) or ({$fieldname} is NULL))";
						}
				}
				$this->filter.="\r\n and ".$whitem;
			}
			
		}
		return $this->DB_GetObjectsWH($justcount);	
		
	}
	
	function DB_GetObjectsMODEL($justcount=0)
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;

		$this->filter = "(1=1) ";
		$ek = @array_keys($this->expresions);
		for($i=0;$i<$this->fieldscount;$i++)
		{
			$fv = eval('return $this->'.$this->fields[$i].';');
			$fv = str_replace("'",QUOTEDELIM,$fv);
			if($fv!=$this->delim)
				if(!@in_array($this->fields[$i],$ek))
					$this->filter.=" and ".$selectfrom.".".$this->fields[$i]."='$fv' ";
				else
					$this->filter.=" and ".$this->expresions[$this->fields[$i]]."='$fv' ";
		}
		return $this->DB_GetObjectsWH($justcount);	
	}	
	
	
	function DB_GetObjectsWH_J_GenOBJ($dbline,$tables)
	{
		$tablename = $tables[0];
		$tables = array_slice($tables,1);


		if(class_exists("t".$tablename))
		$obj =  eval('return new t'.$tablename.'($tablename,$this->tbl_prefix);');
			else
		$obj = new CDBObject($tablename,"");
		
		$obj->DB_FetchFromArray($dbline);
		$dbline = array_slice($dbline,$obj->fieldscount);
		$this->jrccount++;
		$jrccount = $this->jrccount;
		for($i=0;$i<count($this->jctables[$jrccount]);$i++)
		{
			$cr = $this->DB_GetObjectsWH_J_GenOBJ($dbline,$tables);
			eval('$obj->'.$tables[0].'=$cr[2];');
			$tables = $cr[0];
			$dbline = $cr[1];
		}
		return array
						(
							0=>$tables,
							1=>$dbline,
							2=>$obj
						);
	}
	
	function DB_GetObjectsWH_J_GenWH($where_clause,$levels,$level,$tables,$allowtables)
	{
		if($level>=$levels) return 0;
		$tablename = $tables[count($tables)-1];
		$alias = "tbl".(count($tables)-1);
		// get it's relations
		global $_GLOBALSESSION;
		$relations = $_GLOBALSESSION["bapi"]["db"][DB_DB][$this->tablename]["from"];
		$this->jrccount++;
		$jrccount = $this->jrccount;
		$this->jctables[$jrccount] = array();
		$rk = array_keys($relations);
		for($i=0;$i<count($relations);$i++)
		{
			if(($allowtables!=-1)&&(!in_array($relations[$rk[$i]]['tableto'],$allowtables))) continue;
			$this->jctables[$jrccount][$i] = $relations[$rk[$i]]['tableto'];
			$alias2 = "tbl".count($tables);
			$tables[count($tables)] = $relations[$rk[$i]]['tableto'];
			$where_clause.=" and (".$alias.".".$relations[$rk[$i]]['field_from']."=".$alias2.".".$relations[$rk[$i]]['fieldto'].")";
			$cr = $this->DB_GetObjectsWH_J_GenWH($where_clause,$levels,$level+1,$tables,$allowtables);
			if($cr!=0)
			{
				$where_clause=" ".$cr[0]." ";
				$tables = $cr[1];
			}
		}
		return array
						(
							0=>$where_clause,
							1=>$tables
						);
		
	}
	
	function DB_GetObjectsWH_J($levels,$allowtables=-1)
	{
		$where_clause = $this->customfilter;
		$this->jrccount = 0;
		$this->jctables = array();
		$this->jctables[0][0] = $this->tablename;
		$cr = $this->DB_GetObjectsWH_J_GenWH("(1=1)",$levels,0,array(0=>$this->tablename),$allowtables);
		$tables = $cr[1];
		if($where_clause)
			$where_clause = "($where_clause) and ($cr[0])";
		else
			$where_clause = "($cr[0])";
		$tableslist = $this->tablename." tbl0 ";
		for($i=1;$i<count($tables);$i++) 
			$tableslist.= ",".$tables[$i]." tbl".$i;
			
		$top = "";
		if((USEDBENGINE=="MSSQL")&&($this->count)) $top = " TOP ".($this->count+$this->start);
		$query = "select ".$top." * from $tableslist where $where_clause";
		if($this->orderby!="") $query.=" order by $this->orderby ";
		if($this->count) 
		{
			if(USEDBENGINE=="MYSQL") $query.=" limit $this->start,$this->count";
			elseif(USEDBENGINE=="POSTGRESQL") $query.= " limit $this->count offset $this->start";
		}
		$result = $this->Query($query);

		if((USEDBENGINE=="MSSQL")&&($this->start)) b_data_seek($result,$this->start);
			
		$numrows = b_num_rows($result);
		if($this->count)
			if($this->count<b_num_rows($result)) $numrows = $this->count;
		
		
		$this->items = array();
		for($i=0;$i<b_num_rows($result);$i++)
		{
			$dbline = b_fetch_row($result);
			$this->jrccount = 0;
			$cr = $this->DB_GetObjectsWH_J_GenOBJ($dbline,$tables);
			$this->items[$i] = $cr[2];
		}
		return $this->items;
	}
	
	
	function DB_Delete()
	{
		for($i=0;$i<count($this->items);$i++)
			$this->items[$i]->DB_Delete();
	}
	
	function DB_Activate($status)
	{
		for($i=0;$i<count($this->items);$i++)
			$this->items[$i]->DB_Activate($status);
	}
}

?>