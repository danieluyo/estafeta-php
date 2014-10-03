<?php

use Ivansabik\Estafeta\Estafeta;

class CotizacionTest extends \PHPUnit_Framework_TestCase {

    private $_estafeta;
    private static $_assertSobre = array(
        'costos_envio' =>
        array(
            array(
                'producto' => '11:30',
                'peso_kg' => '0.00',
                'tarifa_guia' => '192.72',
                'tarifa_combustible' => '9.44',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '202.16',
            ),
            array(
                'producto' => 'Dia Sig.',
                'peso_kg' => '0.00',
                'tarifa_guia' => '159.15',
                'tarifa_combustible' => '7.80',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '166.95',
            ),
            array(
                'producto' => '2 Dias',
                'peso_kg' => '0.00',
                'tarifa_guia' => '129.93',
                'tarifa_combustible' => '6.37',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '136.30',
            ),
            array(
                'producto' => 'Terrestre',
                'peso_kg' => '0.00',
                'tarifa_guia' => '158.51',
                'tarifa_combustible' => '7.77',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '166.28',
            )
        )
    );
    private static $_assertPaquete = array(
        'costos_envio' =>
        array(
            array(
                'producto' => '11:30',
                'peso_kg' => '1.00',
                'tarifa_guia' => '192.72',
                'tarifa_combustible' => '9.44',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '202.16',
            ),
            array(
                'producto' => 'Dia Sig.',
                'peso_kg' => '1.00',
                'tarifa_guia' => '159.15',
                'tarifa_combustible' => '7.80',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '166.95',
            ),
            array(
                'producto' => '2 Dias',
                'peso_kg' => '1.00',
                'tarifa_guia' => '129.93',
                'tarifa_combustible' => '6.37',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '136.30',
            ),
            array(
                'producto' => 'Terrestre',
                'peso_kg' => '1.00',
                'tarifa_guia' => '158.51',
                'tarifa_combustible' => '7.77',
                'cargos_extra' => '0.00',
                'sobrepeso_costo' => '0.00',
                'sobrepeso_combustible' => '0.00',
                'costo_total' => '166.28',
            )
        )
    );

    protected function setUp() {
        $this->_estafeta = new Estafeta();
    }

    function testSobre() {
        $html = '<table width="593" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td width="12" height="58" valign="top" background="/Images/lineageneralizquierda.png">&nbsp;</td><td width="699" valign="middle" background="/Images/medioazulgeneral.png"><div align="right"><img align="right" src="/Images/herramientas.png" width="333" height="31"></div></td><td width="12" valign="top" background="/Images/derechaazulgeneral.png">&nbsp;</td></tr><tr><td height="33" colspan="3" valign="top" background="/Images/separaseccroja.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td width="258"><img src="/Images/cotizadortitulo.png" width="258" height="27"></td><td width="440">&nbsp;</td><td width="25"></td></tr></tbody></table></td></tr><tr><td colspan="3" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr><td height="25" class="style23">&nbsp;</td></tr><tr><td height="25" class="style23"><div align="center"><!--Cancelado por que no hay funcionalidad<form name="TarificadorForm" method="post" action="/Tarificador/admin/TarificadorAction.do">--><input name="cIdioma2" value="espanol" type="hidden"><!-- primer tabla --><table border="0" cellpadding="0" align="left" width="100%"><tbody><tr><td width="120" height="25" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Tipo de envio:</strong></div></td><td width="120" bgcolor="#e7e7de" class="style1"><div align="left"><input type="text" name="tarificador.tipoEnvio" size="10" value="SOBRE" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #575553;font-weight: bold; text-align: justify; background-color: #e7e7de; border: 0;"></div></td><td bgcolor="#f6ecce"><div align="left"></div></td></tr><tr><td height="21" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Origen:</strong></div></td><td bgcolor="#e7e7de" class="style1"><div align="left">CP<input type="text" name="tarificador.codPosOri.codigoPostal" size="6" value="01210" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #e7e7de;border: 0;"></div></td><td bgcolor="#f6ecce" class="style1"><div align="left"><input type="text" name="tarificador.codPosOri.desMuniEstado" size="60" value="ALVARO OBREGON, DISTRITO FEDERAL " readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #f6ecce;border: 0;"></div></td></tr><tr><td height="23" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Destino:</strong></div></td><td bgcolor="#e7e7de" class="style1"><div align="left">CP<input type="text" name="tarificador.codPosDest.codigoPostal" size="6" value="86035" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #e7e7de;border: 0; border: 0;"></div></td><td bgcolor="#f6ecce"><div align="left"><span class="style1"><input type="text" name="tarificador.codPosDest.desMuniEstado" size="60" value="CENTRO, TABASCO " readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #f6ecce;border: 0;"></span></div></td></tr></tbody></table><!-- Fin primer tabla--></div></td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1"><tbody><tr><td width="100%"><div align="center"><table border="0" bordercolor="#ffffff" cellpadding="2" cellspacing="1" align="left" width="100%"><tbody><tr><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1"><p align="center" class="style4"><strong>Producto </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1"><p align="center"><strong>Peso kg </strong></p></td><td height="13" colspan="2" bgcolor="#f6ecce" class="style1"><p align="center" class="style4"><strong>Tarifa </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1" width="75"><p align="center"><strong>Cargos Extra </strong></p></td><td height="13" colspan="2" bgcolor="#f6ecce" class="style1"><p align="center" class="style4"><strong>Sobrepeso </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1" width="75"><p align="center" class="style4"><strong>Costo</strong><br><strong>Total</strong></p></td></tr><tr bgcolor="#003366"><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>Guia </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>CC </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>Costo </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>CC </strong></p></td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>11:30</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">192.72</td><td align="right" bgcolor="#f6ecce" height="30">9.44</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">202.16</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>Dia Sig.</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">159.15</td><td align="right" bgcolor="#f6ecce" height="30">7.80</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">166.95</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>2 Dias</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">129.93</td><td align="right" bgcolor="#f6ecce" height="30">6.37</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">136.30</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>Terrestre</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">158.51</td><td align="right" bgcolor="#f6ecce" height="30">7.77</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">166.28</td></tr></tbody></table></div></td></tr></tbody></table></td></tr><tr><td><ul><li class="style1"><div align="left"><span class="style4">Peso:</span> Se aplica el <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/zonas-sobrepeso-peso-volumetrico.aspx" target="_blank">peso volumetrico </a>cuando este es superior al peso fisico.</div></li><li class="style1"><div align="left"><span class="style4">CC:</span> <a class="cuerpo" href="http://www.estafeta.com/atencion-a-clientes/cargo-por-combustible.aspx" target="_blank">Cargo por Combustible.</a></div></li><li class="style1"><div align="left"><span class="style4">Cargos Extra:</span> En su caso, aplica la tarifa de reexpedicion.No incluye el costo de <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/servicios-complementarios.aspx" target="_blank">servicios complementarios</a> ni el cargo por <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/cargos-adicionales.aspx" target="_blank">envios de manejo especial.</a></div></li><li class="style1"><div align="left">Los precios no incluyen el IVA.</div></li><li class="style1"><div align="left">Precios sujetos a cambio sin previo aviso.</div></li></ul></td></tr></tbody></table></td></tr><tr><td height="60" valign="top" background="/images/bajoizquierdoazulgener.png"><p>&nbsp;</p></td><td valign="top" background="/images/medioazulbajogener.png">&nbsp;</td><td valign="top" background="http://www.estafeta.com//imagenes/bajoderechoazulgener.png">&nbsp;</td></tr></tbody></table>';
        $this->llamarMetodoHtml($html);
        $this->_estafeta->cotizar('01210', '86025');
        $costos = $this->_estafeta->cotizacion;
        $this->assertEquals(self::$_assertSobre, $costos);
    }

    function testPaquete() {
        $html = '<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tbody><tr><td height="25" class="style23">&nbsp;</td></tr><tr><td height="25" class="style23"><div align="center"><!--Cancelado por que no hay funcionalidad<form name="TarificadorForm" method="post" action="/Tarificador/admin/TarificadorAction.do">--><input name="cIdioma2" value="espanol" type="hidden"><!-- primer tabla --><table border="0" cellpadding="0" align="left" width="100%"><tbody><tr><td width="120" height="25" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Tipo de envio:</strong></div></td><td width="120" bgcolor="#e7e7de" class="style1"><div align="left"><input type="text" name="tarificador.tipoEnvio" size="10" value="PAQUETE" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #575553;font-weight: bold; text-align: justify; background-color: #e7e7de; border: 0;"></div></td><td bgcolor="#f6ecce"><div align="left"></div></td></tr><tr><td height="21" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Origen:</strong></div></td><td bgcolor="#e7e7de" class="style1"><div align="left">CP<input type="text" name="tarificador.codPosOri.codigoPostal" size="6" value="01210" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #e7e7de;border: 0;"></div></td><td bgcolor="#f6ecce" class="style1"><div align="left"><input type="text" name="tarificador.codPosOri.desMuniEstado" size="60" value="ALVARO OBREGON, DISTRITO FEDERAL " readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #f6ecce;border: 0;"></div></td></tr><tr><td height="23" background="http://www.estafeta.com/imagenes/celdaroja.jpg" bgcolor="#FFFFFF" class="style5"><div align="left" style="margin-left: 5px;"><strong>Destino:</strong></div></td><td bgcolor="#e7e7de" class="style1"><div align="left">CP<input type="text" name="tarificador.codPosDest.codigoPostal" size="6" value="86035" readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #e7e7de;border: 0; border: 0;"></div></td><td bgcolor="#f6ecce"><div align="left"><span class="style1"><input type="text" name="tarificador.codPosDest.desMuniEstado" size="60" value="CENTRO, TABASCO " readonly="readonly" style="font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif;color: #575553; font-weight: bold; text-align: justify; background-color: #f6ecce;border: 0;"></span></div></td></tr></tbody></table><!-- Fin primer tabla--></div></td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1"><tbody><tr><td width="100%"><div align="center"><table border="0" bordercolor="#ffffff" cellpadding="2" cellspacing="1" align="left" width="100%"><tbody><tr><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1"><p align="center" class="style4"><strong>Producto </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1"><p align="center"><strong>Peso kg </strong></p></td><td height="13" colspan="2" bgcolor="#f6ecce" class="style1"><p align="center" class="style4"><strong>Tarifa </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1" width="75"><p align="center"><strong>Cargos Extra </strong></p></td><td height="13" colspan="2" bgcolor="#f6ecce" class="style1"><p align="center" class="style4"><strong>Sobrepeso </strong></p></td><td height="13" rowspan="2" bgcolor="#d6d6d6" class="style1" width="75"><p align="center" class="style4"><strong>Costo</strong><br><strong>Total</strong></p></td></tr><tr bgcolor="#003366"><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>Guia </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>CC </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>Costo </strong></p></td><td height="13" bgcolor="#e7e7de" class="style1"><p align="center"><strong>CC </strong></p></td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>11:30</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">1.00</td><td align="right" bgcolor="#f6ecce" height="30">192.72</td><td align="right" bgcolor="#f6ecce" height="30">9.44</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">202.16</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>Dia Sig.</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">1.00</td><td align="right" bgcolor="#f6ecce" height="30">159.15</td><td align="right" bgcolor="#f6ecce" height="30">7.80</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">166.95</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>2 Dias</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">1.00</td><td align="right" bgcolor="#f6ecce" height="30">129.93</td><td align="right" bgcolor="#f6ecce" height="30">6.37</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">136.30</td></tr><tr class="style1"><td height="22" align="right" background="http://www.estafeta.com/imagenes/celdaroja.jpg" class="style5"><div align="center"><strong>Terrestre</strong></div></td><td align="right" bgcolor="#f6ecce" height="30">1.00</td><td align="right" bgcolor="#f6ecce" height="30">158.51</td><td align="right" bgcolor="#f6ecce" height="30">7.77</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">0.00</td><td align="right" bgcolor="#f6ecce" height="30">166.28</td></tr></tbody></table></div></td></tr></tbody></table></td></tr><tr><td><ul><li class="style1"><div align="left"><span class="style4">Peso:</span> Se aplica el <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/zonas-sobrepeso-peso-volumetrico.aspx" target="_blank">peso volumetrico </a>cuando este es superior al peso fisico.</div></li><li class="style1"><div align="left"><span class="style4">CC:</span> <a class="cuerpo" href="http://www.estafeta.com/atencion-a-clientes/cargo-por-combustible.aspx" target="_blank">Cargo por Combustible.</a></div></li><li class="style1"><div align="left"><span class="style4">Cargos Extra:</span> En su caso, aplica la tarifa de reexpedicion.No incluye el costo de <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/servicios-complementarios.aspx" target="_blank">servicios complementarios</a> ni el cargo por <a class="cuerpo" href="http://www.estafeta.com/servicios/mensajeria-y-paqueteria/servicios-nacionales/cargos-adicionales.aspx" target="_blank">envios de manejo especial.</a></div></li><li class="style1"><div align="left">Los precios no incluyen el IVA.</div></li><li class="style1"><div align="left">Precios sujetos a cambio sin previo aviso.</div></li></ul></td></tr></tbody></table>';
        $this->llamarMetodoHtml($html);
        $this->_estafeta->cotizar('01210', '86025', 1, 10, 20, 20);
        $costos = $this->_estafeta->cotizacion;
        $this->assertEquals(self::$_assertPaquete, $costos);
    }
    
    function llamarMetodoHtml($html) {
        $reflection = new \ReflectionClass(get_class($this->_estafeta));
        $method = $reflection->getMethod('_html');
        $method->setAccessible(true);
        return $method->invokeArgs($this->_estafeta, array($html));
    }

}
