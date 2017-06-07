<?
/*---------------------------------------------------------------------------
		File		: class.dbbaseobject.php
		Desc		: implements CDBBaseObject
		Author	: Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 21-aug-2004
		Version : 1.0
		Updates : 
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 19-jan-2005
		Version : 1.1
		Desc		: Proper null handling
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 21-jan-2005
		Version : 1.11
		Desc		: Extended Delete and Update on the Model base
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 16-mar-2005
		Version : 1.12
		Desc		: Corrected the way the column metadata is collected for Postgres tables
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 26-mar-2005
		Version : 1.13
		Desc		: (+) DB_AddField
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 16-mar-2005
		Version : 1.14
		Desc		: (+) MSSQL Support
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 23-may-2005
		Version : 1.15
		Desc		: (+) BIG NULL HANDLING BUG in ComposeWH fixed. All previous versions
							show be updated.
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 25-may-2005
		Version : 1.16
		Desc		: (+) Query()
							(+) affected rows
	-----------------------------------------------------------------------------
		Author	:	Sebastian Cristea - BITNET Software - www.bitnet.info
		Created : 27-jul-2005
		Version : 1.16
		Desc		: (+) $_addtables
							
	---------------------------------------------------------------------------*/

/**
	Name: CDBBaseObject
	Description: Base bapi database object. 
							 One instance of this class corresponds to one record in one table.
							 Provides the following basic functionality:
							 - Reading the table structure
							 - Basic operation: Insert, Update, Select one element, Delete, Activate
*/
class CDBBaseObject extends CObject
{
/*---------------------------------------------------------------------------
															PROPERTIES
---------------------------------------------------------------------------*/	
	var $delim=BAPIDELIM;
	
	var $tablename;
	var $tbl_prefix;
	var $fields;
	var $fieldtypes;
	var $fieldscount;
	var $defaultactive = 1;
	var $keepquotes = 0;
	var $created;
	var $expresions;
	var $phyfiecount;	// physical fields count... used to know where to stop inserting or updating
	var $blobfields;
	var $values;			// read only associative values array - this is only loaded by fetchfromarray(), and ignored by insert,delete etc
  var $query;       // the query that was run
	
	var $forceid;			// if true will use this ident when inserting or updating
	
	var $quotedelim = QUOTEDELIM;
	var $slashdelim = SLASHDELIM;
	
	var $addtables;	// add tables to the fetch... start with ,
	var $_addtables;	// add tables to the join .. for internal use (by inheriting classes)
	
	var $relations; // relations array ie. [tableref]['fieldname'],[tableref]['tableref'],[tableref]['fieldref'],[tableref]['ondelete'],[tableref]['onactivate'] => ondelete,onactivate only works for db systems in which bapirel is used
									// indexed by the target table	
	var $forceswcascade = -1;	// overwrite when extending this class to force one or another behaviour of bapirel
	var $swcascade;						// use sw cascade - this defaults to
														// 1 - MySQL
														// 0 - PostgreSQL, and other engines you are not interested in sw cascade - on it's way out
														
	var $manageupdated;		// manageupdated field...
	
	var $view;													// use a view instead of the base table for selects... the view must contain all the base table fields
																			// extra fields in the table must be added in the fields/expresions arrays
	var $updatefilter;					// extra update filter
	var $isview;								// whether this object is built over a view or not
	
	var $affectedrows;					// number of rows affected by the last request
	
	var $fieldpositions;
/*---------------------------------------------------------------------------
															EVENTS
---------------------------------------------------------------------------*/	
	/**
	* @return int
	* @param  dbline
	* @desc 
	*	Called before fetching information from a dbline (DB_FetchFromArray) to it's internal structure.
	*	Use it to perform data processing or filtering between the database and the interface format.
	*	Returning 0 will stop DB_Fetch
	*/
	function DBE_BeforeFetch($dbline)
	{
		return 1;
	}
	function DBE_AfterFetch($dbline)
	{
		return 1;
	}
	function DBE_BeforeInsert()
	{
		return 1;
	}
	function DBE_AfterInsert()
	{
		return 1;
	}
	function DBE_BeforeDelete()
	{
		return 1;
	}
	function DBE_AfterDelete()
	{
		return 1;
	}
	function DBE_BeforeUpdate()
	{
		return 1;
	}
	function DBE_AfterUpdate()
	{
		return 1;
	}
	function DBE_BeforeActivate()
	{
		return 1;
	}
	function DBE_AfterActivate()
	{
		return 1;
	}
	function DBE_AfterCreate()
	{
		return 1;
	}
	
	function Query($query)
	{
		$result = b_query($query);
		$this->query = $query;
		$this->affectedrows = b_affected_rows($result);
		return $result;
	}

	function DB_AddField($field,$expression="")
	{
		if($expression=="") $expression = $field;
		$this->fields[] = $field;
		$this->fieldscount++;
		$this->expresions[$field] = $expression;
		eval('$this->'.$field.'="'.$this->delim.'";');
	}
	
	function CDBBaseObject($tablename="",$tbl_prefix="")
	{
		if($tablename)	$this->tablename = $tablename;
		if($tbl_prefix)	$this->tbl_prefix = $tbl_prefix;
	
		$this->fields = array();
		$this->fieldtypes = array();
		
		// obtain the table structure... this depends on the database engine
		if(USEDBENGINE=="MYSQL")
		{
			$this->manageupdated = 1;
			$this->swcascade = 1;
			// get the columns
			$result = $this->Query("show columns from ".$this->tablename);
			$this->fieldscount = b_num_rows($result);
			for($i=0;$i<b_num_rows($result);$i++)
			{
				$dbline = b_fetch_row($result);
	   		$this->fields[$i] = $dbline[0];
	   		$this->fieldpositions[$dbline[0]] = $i;
				eval('$this->'.$this->fields[$i].'="'.$this->delim.'";'); 	
				$this->fieldtypes[$i] = $dbline[1];
			}
		}
		elseif(USEDBENGINE=="POSTGRESQL")
		{
			$this->swcascade = 0;
			$this->manageupdated = 1;
			// obtain reltype
			$dbline = $this->Query("select oid,relkind from pg_class where relname='".strtolower($this->tablename)."'");
			$dbline = b_fetch_row($dbline);
			$reltype = $dbline[0];
			if($dbline[1] == 'r') $this->isview = 0;
			if($dbline[1] == 'v') $this->isview = 1;

			// now get the columns		
			$result = $this->Query("select attname,typname,atttypmod-4 from pg_type,pg_attribute where (atttypid=typelem) and (attrelid={$reltype}) and (attstattarget!=0) and (typstorage='x') order by attnum");
			$this->fieldscount = b_num_rows($result);
			for($i=0;$i<b_num_rows($result);$i++)
			{
				$dbline = b_fetch_row($result);
	   		$this->fields[$i] = $dbline[0];
	   		$this->fieldpositions[$dbline[0]] = $i;
	   		eval('$this->'.$this->fields[$i].'="'.$this->delim.'";'); 	
				$this->fieldtypes[$i] = substr($dbline[1],1);
				if($dbline[2]!=-5) $this->fieldtypes[$i].="({$dbline[2]})";
			}
		}
		elseif(USEDBENGINE=="MSSQL")
		{
			$this->swcascade = 0;
			$this->manageupdated = 1;
			// obtain reltype
			$dbline = $this->Query("select type from sysobjects where name='".strtolower($this->tablename)."'");
			$dbline = b_fetch_row($dbline);
			if($dbline[0] == 'U') $this->isview = 0;
			if($dbline[0] == 'V') $this->isview = 1;

			// now get the columns		
			
			$result = $this->Query("select top 0 * from ".strtolower($this->tablename));
			$this->fieldscount = b_num_fields($result);
			for($i=0;$i<$this->fieldscount;$i++)
			{
				$this->fields[$i] = b_field_name($result,$i);
	   		$this->fieldpositions[b_field_name($result,$i)] = $i;				
				eval('$this->'.$this->fields[$i].'="'.$this->delim.'";'); 	
				$this->fieldtypes[$i] = b_field_type($result,$i)."(".b_field_length($result,$i).")";
			}
		}
		if($this->forceswcascade!=-1) $this->swcascade = $this->forceswcascade;
		b_load_references();			
		
		$this->phyfiecount = $this->fieldscount;
		$this->active = $this->defaultactive;
		$this->expresions = array();
		$this->DBE_AfterCreate();	
	}

	function DB_GetFieldsList()
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;
		$rv="";
		$ek = @array_keys($this->expresions);
		for($i=0;$i<count($this->fields);$i++)
			if(@in_array($this->fields[$i],$ek))
				$rv.=$this->expresions[$this->fields[$i]]." as ".$this->fields[$i].",";
			else
				$rv.=$selectfrom.".".$this->fields[$i].",";
		return substr($rv,0,strlen($rv)-1);
	}
	
	function DB_GetPhyFieldsList()
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;
		$rv="";
		$ek = @array_keys($this->expresions);
		for($i=0;$i<count($this->fields);$i++)
			if(!@in_array($this->fields[$i],$ek))
				$rv.=$selectfrom.".".$this->fields[$i].",";
		return substr($rv,0,strlen($rv)-1);
	}	
	
	function DB_Insert()
	{
		return $this->DB_InsertO();
	}
	
	function DB_InsertO()
	{
		if($this->DBE_BeforeInsert()==0) return 0;
		
		if(USEDBENGINE == "POSTGRESQL")
		{
			if((!$this->forceid)&&(!$this->isview))
			{
				$this->ident = b_quick_value("select nextval('{$this->tablename}_ident');");
				$this->forceid = 1;
			}
		}

		if($this->created==$this->delim) $this->created = time();
		if($this->manageupdated) if($this->updated==$this->delim) $this->updated = time();
		
		if($this->active==$this->delim) $this->active = $this->defaultactive;
		$query = "insert into $this->tablename (";
		for($i=0;$i<$this->phyfiecount;$i++) 
			if(($this->fields[$i]!="ident")||($this->forceid)||($this->isview))
			{
				$fv = eval('return $this->'.$this->fields[$i].';');
				if($fv!=$this->delim)
					$query.=$this->fields[$i].",";
			}
		$query = substr($query,0,strlen($query)-1);
		$query.=") values (";
		for($i=0;$i<$this->phyfiecount;$i++) 
			if(($this->fields[$i]!="ident")||($this->forceid)||($this->isview))
			{
				$fv = eval('return $this->'.$this->fields[$i].';');
				if(is_null($fv))
						$query.="null,";
				elseif($fv!=$this->delim)
				{
					$fv = str_replace("'",$this->quotedelim,$fv);
					$fv = str_replace("\\",$this->slashdelim,$fv);
					$query.="'".$fv."',";
				}
			}
		$query = substr($query,0,strlen($query)-1);
		$query.=");";
		
		if(!$this->Query($query)) return 0;
		if((USEDBENGINE=='MYSQL') || (USEDBENGINE=='MSSQL'))
			$this->ident = b_insert_id();
		return $this->DBE_AfterInsert();
	}
	
	function DB_FetchFromArray($dbline)
	{
		return $this->DB_FetchFromArrayO($dbline);
	}
	
	function DB_FetchFromArrayO($dbline)
	{
		$this->values = array();
		if($this->DBE_BeforeFetch($dbline)==0) return 0;
		
		$this->fieldscount = count($this->fields);
		for($i=0;$i<$this->fieldscount;$i++) 
		{
			if((($this->fieldtypes[$i]=="blob")||($this->fieldtypes[$i]=="longblob"))&&($dbline[$i]!=""))
				$dbline[$i] = $this->delim;
			if(is_null($dbline[$i]))
				eval('$this->'.$this->fields[$i].'=NULL;'); 
			else
			{
				$dbline[$i] = str_replace($this->slashdelim,"\\",$dbline[$i]);
				eval('$this->'.$this->fields[$i].'=\''.$dbline[$i].'\';'); 
				eval('$this->'.$this->fields[$i].'=str_replace('.$this->quotedelim.',"'.'\''.'",$this->'.$this->fields[$i].');'); 
				$this->values[$this->fields[$i]] = str_replace($this->quotedelim,"'",$dbline[$i]);
			}		
		}
		return $this->DBE_AfterFetch($dbline);	
	}
	
	function DB_FetchByMODEL()
	{
		
		return $this->DB_FetchByMODELO();
	}
	
	function ComposeWHModel()
	{
		$wh = "(1=1) ";
		for($i=0;$i<$this->fieldscount;$i++)
		{
			$fv = eval('return $this->'.$this->fields[$i].';');
			if($fv!=$this->delim)
				if(!@array_key_exists($this->fields[$i],$this->expresions))
				{
					if(is_null($fv))
						$wh.="and (".$this->tablename.'.'.$this->fields[$i]." is null)";
					else
					{
						$fv = str_replace("'",QUOTEDELIM,$fv);
						$wh.="and (".$this->tablename.'.'.$this->fields[$i]." = '".$fv."')";
					}
				}
				else 
				{
					if(is_null($fv))
						$wh.="and (".$this->fields[$i]." is null)";
					else
					{
						$fv = str_replace("'",QUOTEDELIM,$fv);
						$wh.="and (".$this->fields[$i]." = '".$fv."')";
					}
				}
		}
		return $wh;
	}
	
	function DB_FetchByMODELO()
	{
		$fields = array();
/*		for($i=0;$i<$this->fieldscount;$i++)
		{
			$fv = eval('return $this->'.$this->fields[$i].';');
			if($fv!=$this->delim)
				if(!@array_key_exists($this->fields[$i],$this->expresions))
					$fields[$this->fields[$i]] = $fv;
		}
		return $this->DB_FetchByFields($fields);*/
		return $this->DB_FetchByWH($this->ComposeWHModel());
		
	}
	
	function DB_FetchByWH($wh)
	{
		return $this->DB_FetchByWHO($wh);
	}
	
	function DB_FetchByWHO($wh)
	{
		$selectfrom = $this->tablename;
		if($this->view) $selectfrom = $this->view;
		$query = "select ".$this->DB_GetFieldsList()."	from $selectfrom $this->_addtables $this->addtables where $wh";
		$result = $this->Query($query);
		if(!b_num_rows($result)) return 0;
		$dbline = b_fetch_row($result);
		$this->DB_FetchFromArray($dbline);
		return 1;
	}
	
	function DB_FetchByFields($fields)
	{
		return $this->DB_FetchByFieldsO($fields);
	}

	function DB_FetchByFieldsO($fields)
	{
		$fvs = array_values($fields);
		$fks = array_keys($fields);
		$fcount = count($fvs);
		$wh = "(1=1)";
		for($i=0;$i<$fcount;$i++)
			$wh.="and ($fks[$i]='$fvs[$i]') ";
		return $this->DB_FetchByWH($wh);
	}
	
	function DB_Fetch()
	{
		return $this->DB_FetchO();
	}
	
	function DB_FetchO()
	{
		return $this->DB_FetchByFields(array("ident"=>$this->ident));
	}

	function DB_Update()
	{
		return $this->DB_UpdateO();
	}
	
	function DB_UpdateO()
	{
		if($this->DBE_BeforeUpdate()==0) return 0;

		if($this->manageupdated) $this->updated = time();

		$query = "update $this->tablename set ";
		for($i=0;$i<$this->phyfiecount;$i++) 
			if(($this->fields[$i]!="ident")||($this->forceid))
			{
				$fv = eval('return $this->'.$this->fields[$i].';');
				if(is_null($fv))
					$query.=$this->fields[$i]."=null,";
				elseif($fv!=$this->delim)
				{
					$fv = str_replace("'",$this->quotedelim,$fv);
					$fv = str_replace("\\",$this->slashdelim,$fv);
					$query.=$this->fields[$i]."='".$fv."',";
				};
			}
		$query = substr($query,0,strlen($query)-1);
		$query.= " where ident=".$this->ident;
		if($this->updatefilter) $query.=" and $this->updatefilter";
		if(!$this->Query($query)) return 0;
		return $this->DBE_AfterUpdate();
	}
	
	function DB_Delete()
	{
		return $this->DB_DeleteO();
	}

	function DB_DeleteO()
	{
		$this->DB_DeleteA();

	}
	
	function DB_DeleteA()
	{
		if($this->DBE_BeforeDelete()==0) return 0;
		
		$query = "delete from $this->tablename where ".$this->ComposeWHModel();
		
		if(!$this->Query($query)) return 0;
		return $this->DBE_AfterDelete();
	}

	function DB_Activate($status)
	{
		$this->DB_ActivateA($status);
	}
	
	function DB_ActivateA($status)
	{
		if($this->DBE_BeforeActivate()==0) return 0;
		
		$this->active = $status;
		$this->DB_Update();

		return $this->DBE_AfterActivate();
	}
	
}

?>