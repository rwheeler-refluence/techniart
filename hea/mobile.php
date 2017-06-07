<script type="text/javascript">
    var nmpar = 'nomobile';
    var r = new RegExp("[\\?&]"+nmpar+"=([^&#]*)");
    var res = r.exec(window.location.href);
    if (res != null && res[1] == 'true') 
        document.cookie = nmpar+'=true;';

    r = new RegExp(";?" + nmpar + "=([^;]*)");
    res = r.exec(document.cookie);

    var is_mobile = (res == null || res[1] != 'true');
    if (navigator.userAgent.match(/(Ahong|^Aiko|Alcatel|Amoi|Android|Asus|Avvio|^BBK|Beetel|^BenQ|BlackBerry|BB10;.*Mobile|^Bleu|BOLT.*AppleWebkit|BREW/|CELLTEL|CHERR[\W_]|^CHL-|CoolPad|COSHIP|^Cricket|\(Danger|Desay|Docomo|dopod|^Dorado|Eme?geton|EPHONE|Ericsson|Linux arm.*(Firefox/|Fennec/)|^Fly|G-Fone|GIONEE|Ha(ei|ie)r|Huawei|i-mate|iPAQ|iP(hone|od)|Karbonn|KDDI|Kindle/|KONKA|K-?TOUCH|KWC|^LAVA|^Lemon|Lenovo|LGE?-|Maemo|^MAUI|MDS_|^Mercury|Micromm?ax|MIDP|MOT-|^NEC|NetFront|Nexian|Nokia|Obigo|Openwave|Opera (Mini|Mobi)|^OP(PO|WV)|Palm|Panasonic|Pantech|Philips|QQBrowser|Sagem|Samsung|Sanyo|Sharp|SIE-|Sony|Spice|Symbian|Tablet|TIANYU|Toshiba|Ucweb|UP\.(Link|Browser)|Videocon|Vodafone|Voxtel|webOS|Windows (CE|Phone)|^Y2\d|ZTE-)/i) != null)
      is_mobile = true;

    else if (screen && (screen.width > 855 || screen.height > 855))
      is_mobile = false;

    if (is_mobile) 
        window.location = "http://m.techniart.com/";
</script>