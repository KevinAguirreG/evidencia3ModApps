<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_branches = array(
            array("val0"=>"2929","val1"=>"HEB MTY LA PUERTA","val2"=>"7504000225461","val3"=>"00929","val4"=>"Carr. Mty-Slt #2640Cumbres Sta Catarina C.P. 66358","val5"=>"Santa Catarina"),
            array("val0"=>"2993","val1"=>"HEB SAL SAN PATRICIO","val2"=>"7504000225447","val3"=>"00993","val4"=>"Blvd. Eulalio Glz #2275Exhda. San José C.P. 25293 ","val5"=>"Saltillo"),
            array("val0"=>"2923","val1"=>"MT MTY CABEZADA","val2"=>"7504000225454","val3"=>"00923","val4"=>"Av. Cabezada #100Fomerrey 114 C.P. 64105","val5"=>"Monterrey"),
            array("val0"=>"2995","val1"=>"MT REY AEROPUERTO","val2"=>"7504000225478","val3"=>"00995","val4"=>"Reynosa-Mzt Km 85 #300Fracc. Reynosa C.P. 88501","val5"=>"Reynosa"),
            array("val0"=>"2930","val1"=>"HEB MAT LAURO VILLAR","val2"=>"7504000225492","val3"=>"00930","val4"=>"Lauro Villar#1220Norberto Treviño Zapat C.P. 87450","val5"=>"Matamoros"),
            array("val0"=>"2932","val1"=>"MT MTY METROPLEX","val2"=>"7504000225485","val3"=>"00932","val4"=>"Av. Concordia 1300Hacienda Santa Isabel C.P. 66612","val5"=>"Apodaca"),
            array("val0"=>"2933","val1"=>"HEB TOR REVOLUCION","val2"=>"7504000225539","val3"=>"00933","val4"=>"Blvd Revolución Ote #2840Torreón Jardín C.P. 27001","val5"=>"Torreón"),
            array("val0"=>"2935","val1"=>"HEB MTY LAS PUENTES","val2"=>"7504000225546","val3"=>"00935","val4"=>"Av Rep Mexicana #201Las Puentes 2do Sec C.P. 66460","val5"=>"San Nicolas"),
            array("val0"=>"2926","val1"=>"HEB MTY PUERTA DE HIERRO","val2"=>"7504000225515","val3"=>"00926","val4"=>"Av Leones #8901Puerta de Hierro Cumbres C.P. 64349","val5"=>"Monterrey"),
            array("val0"=>"2936","val1"=>"HEB TAM MADERO","val2"=>"7504000225553","val3"=>"00936","val4"=>"Blvd Adolfo López Mateos #201Unidad Nal C.P. 89410","val5"=>"Madero "),
            array("val0"=>"2985","val1"=>"HEB AGS AGUASCALIENTES","val2"=>"7504000225560","val3"=>"00985","val4"=>"Ave. Independencia No. 1831Col. Trojes de Alonso  ","val5"=>"AGUASCALIENTES"),
            array("val0"=>"2937","val1"=>"HEB LEO CERRO GORDO","val2"=>"7504000225577","val3"=>"00937","val4"=>"Cerro Gordo del Campestre #401Col. Lomas del Campe","val5"=>"León"),
            array("val0"=>"2921","val1"=>"MT MTY GARCIA","val2"=>"7504000225509","val3"=>"00921","val4"=>"Blvd. Heberto Castillo #101Colonia Emiliano Zapata","val5"=>"García "),
            array("val0"=>"2991","val1"=>"MT SAL FUNDADORES","val2"=>"7504000225614","val3"=>"00991","val4"=>"Boulevard Fundadores 4402San Jose de los Cerritos ","val5"=>"Saltillo"),
            array("val0"=>"2925","val1"=>"MT MTY PLAZA DEL BOSQUE","val2"=>"7504000225621","val3"=>"00925","val4"=>"Raúl Salinas Lozano No. 800Paseo Real C.P. 66072  ","val5"=>"Escobedo"),
            array("val0"=>"2938","val1"=>"MT SAL SATELITE","val2"=>"7504000225645","val3"=>"00938","val4"=>"Periférico Luis Echeverria Alvarez #2395Col. Ciuda","val5"=>"Saltillo"),
            array("val0"=>"2924","val1"=>"HEB MTY TEC","val2"=>"7504000225690","val3"=>"00924","val4"=>"Eugenio Garza Sada 3431Arroyo Seco C.P. 64740","val5"=>"Monterrey"),
            array("val0"=>"2946","val1"=>"HEB MTY EL URO","val2"=>"7504000225706","val3"=>"00946","val4"=>"CARRETERA NACIONAL C.P. 64986","val5"=>"MONTERREY"),
            array("val0"=>"2948","val1"=>"MT NVO REVOLUCION","val2"=>"7504000225713","val3"=>"00948","val4"=>"Av. Tecolotes #8205Col. Lomas del Rio C.P. 88179","val5"=>"Nuevo Laredo"),
            array("val0"=>"2997","val1"=>"HEB QRO EL REFUGIO","val2"=>"7504000225720","val3"=>"00997","val4"=>"EL REFUGIO C.P.","val5"=>"SANTIAGO DE QUERETARO"),
            array("val0"=>"2943","val1"=>"HEB MTY CERRADAS DE ANAHUAC","val2"=>"7504000225669","val3"=>"00943","val4"=>"Av. Concordia Num 100Cerradas de Anahuac C.P. 6605","val5"=>"General Escobedo"),
            array("val0"=>"2934","val1"=>"HEB TOR SENDEROS","val2"=>"7504000225584","val3"=>"00934","val4"=>"Autopista Torreón-San Pedro #1950Ejido La Unión C.","val5"=>"Torreón"),
            array("val0"=>"2992","val1"=>"eFC MTY AARON SAENZ","val2"=>"7504000225737","val3"=>"00992","val4"=>"AARON SAENZ 1717 COLONIA SANTA MARIA C.P. 64650   ","val5"=>"MONTERREY"),
            array("val0"=>"2940","val1"=>"HEB SLP LOS PINOS","val2"=>"7504000225744","val3"=>"00940","val4"=>"TECNOLOGICO, BUGAMBILIAS C.P. 78436  ","val5"=>"SAN LUIS POTOSI"),
            array("val0"=>"2947","val1"=>"HEB SAN PEDRO IV ","val2"=>"7504000225751","val3"=>"00947","val4"=>"","val5"=>""),
            array("val0"=>"20000","val1"=>"CORPORATIVO","val2"=>"7504000225003","val3"=>"20000","val4"=>"Av. Hidalgo #    ,  Col, Obispado","val5"=>"Monterrey"),
            array("val0"=>"2982","val1"=>"HEB QRO JURIQUILLA","val2"=>"7504000225607","val3"=>"00982","val4"=>"Boulevard de Las Ciencias #2060 Int. ASin especifi","val5"=>"Querétaro"),
            array("val0"=>"7002","val1"=>"Planta MAP","val2"=>"7504000225829","val3"=>"11500","val4"=>"Intersección de Arco Vial 4001 KM 28.5 C.P. 66066 ","val5"=>"Escobedo"),
            array("val0"=>"2918","val1"=>"HEB IRA IRAPUATO","val2"=>"7504000225775","val3"=>"00918","val4"=>"PROLONGACION AV. VICENTE GUERRERO NO2685COL TERRAC","val5"=>"IRAPUATO"),
            array("val0"=>"7001","val1"=>"GANADO GORDO","val2"=>"7504000225850","val3"=>"13000","val4"=>"Intersección de Arco Vial 4001 KM 28.5 C.P. 66066 ","val5"=>"Escobedo"),
            array("val0"=>"21000","val1"=>"BODEGA EQUIPO","val2"=>"7504000225782","val3"=>"21000","val4"=>"Bodega # 104,  calle Cerrada , Los Angeles","val5"=>"San Nicolas"),
            array("val0"=>"2917","val1"=>"MT MTY ELOY CAVAZOS","val2"=>"7504000225799","val3"=>"00917","val4"=>"ELOY CAVAZOSSIN NOMBRE C.P.          ","val5"=>"GUADALUPE"),
            array("val0"=>"9301","val1"=>"CAT MEX FRESCOS","val2"=>"7504000225812","val3"=>"10000","val4"=>"Parque Industrial O'DonnellJesus María Pino Suarez","val5"=>"Cuautitlán Izcalli"),
            array("val0"=>"9401","val1"=>"CAT MEX SECOS","val2"=>"7504000225805","val3"=>"10000","val4"=>"Parque Industrial O'DonnellJesus María Pino Suarez","val5"=>"Cuautitlán Izcalli"),
            array("val0"=>"2915","val1"=>"HEB QRO EL MIRADOR","val2"=>"7504000225836","val3"=>"00915","val4"=>"Ave. Prolongación Constituyentes PonientNo. 4, Fra","val5"=>"El Marques"),
            array("val0"=>"9107","val1"=>"MT SAN FERNANDO","val2"=>"7504000225980","val3"=>"09107","val4"=>"San Fernando C.P. 88799 ","val5"=>"REYNOSA"),
            array("val0"=>"7005","val1"=>"COMISARIATO","val2"=>"7504000225843","val3"=>"12500","val4"=>"ANILLO PERIFERICO 4001KM 28.5 C.P. 66066","val5"=>"ESCOBEDO"),
            array("val0"=>"2913","val1"=>"HEB AGS SANTA MONICA","val2"=>"7504000225867","val3"=>"00913","val4"=>"AVENIDA SIGLO XXI 3865COL. BARANDALES DE SAN JOSE ","val5"=>"AGUASCALIENTES"),
            array("val0"=>"2911","val1"=>"MTA NVO REFORMA","val2"=>"7504000225874","val3"=>"00911","val4"=>"AV. REFORMA #5530COL. LOS LAGOS C.P. 88290","val5"=>"NUEVO LAREDO"),
            array("val0"=>"2912","val1"=>"HEB SLP LOMAS","val2"=>"7504000225881","val3"=>"00912","val4"=>"Blvd. Antonio Rocha Cordero No. 2031Fracc. Rincona","val5"=>"SAN LUIS POTOSI"),
            array("val0"=>"2910","val1"=>"EFC QRO QUERETARO","val2"=>"7504000225898","val3"=>"00910","val4"=>"5 DE FEBRERO 1309FELIPE CARRILLO PUERTO C.P. 76138","val5"=>"SANTIAGO DE QUERETARO"),
            array("val0"=>"2944","val1"=>"MT MTY MARGARITAS","val2"=>"7504000225683","val3"=>"00944","val4"=>"Orquidea 610Col. Hacienda Las Margaritas C.P. 6661","val5"=>"GUADALUPE"),
            array("val0"=>"2945","val1"=>"HEB MTY BOSQUES DE LAS LOMAS","val2"=>"7504000225676","val3"=>"00945","val4"=>"AV. PASEO DE LOS LEONES S/NESQ.AV.BOSQUES DE LAS L","val5"=>"GARCIA "),
            array("val0"=>"2907","val1"=>"HEB LEO TORRES LANDA","val2"=>"7504000225904","val3"=>"00907","val4"=>"LEON GUANAJUATOLEON GUANAJUATO C.P. 00000","val5"=>"LEON"),
            array("val0"=>"9100","val1"=>"HEB QRO BERNARDO QUINTANA","val2"=>"7504000225928","val3"=>"09100","val4"=>"Boulevard Bernardo Quintana Arrioja 450Col. Colina","val5"=>"Santiago de Queretaro"),
            array("val0"=>"2906","val1"=>"MT MAT LAS BRISAS","val2"=>"7504000225911","val3"=>"00906","val4"=>"AV. SENDERO NACIONALBRISAS DEL VALLE C.P. 87313","val5"=>"MATAMOROS           "),
            array("val0"=>"9106","val1"=>"HEB MTY DIEGO DIAZ","val2"=>"7504000225973","val3"=>"09106","val4"=>"DIEGO DIAZ DE BERLANGA 469JARDINES DE SANTO DOMING","val5"=>"SAN NICOLAS DE LOS G"),
            array("val0"=>"9102","val1"=>"Satélite CAT Mty Frescos","val2"=>"7504000225935","val3"=>"09102","val4"=>"ANILLOPERIFERICO4001KM.28.5 C.P. 66066","val5"=>"ESCOBEDO            "),
            array("val0"=>"9103","val1"=>"HEB QRO EL JACAL","val2"=>"7504000225959","val3"=>"","val4"=>"Prolongación Av. Del Jacal Col. Corregidora ,76180","val5"=>"SANTIAGO DE QUERETARO"),
            array("val0"=>"9105","val1"=>"HEB QRO SAN JUAN  DEL RIO","val2"=>"7504000225966","val3"=>"09105","val4"=>"Av.  Central","val5"=>"SAN JUAN DEL RIO,QRO"),
            array("val0"=>"9108","val1"=>"HEB MTY RINCONADA","val2"=>"7504000225997","val3"=>"09108","val4"=>"Blvd. Humberto Ramos Lozano","val5"=>"Apodaca"),
            array("val0"=>"2919","val1"=>"HEB QRO ZIBATA","val2"=>"7504000225768","val3"=>"00919","val4"=>"ZIBATA QUERETAROZIBATA QUERETARO C.P. 76269","val5"=>"QUERETARO"),
            array("val0"=>"2916","val1"=>"HEB MTY CUMBRES DOMINIO","val2"=>"7504000226000","val3"=>"00916","val4"=>"Av. Paseo de los Leones y Calzada Las Cumbres","val5"=>"Garcia "),
            array("val0"=>"9104","val1"=>"MT MTY BUENA VISTA","val2"=>"7504000225942","val3"=>"09104","val4"=>"Av. Sendero DivisorioCol. Buena Vista C.P. 66583","val5"=>"El Carmen"),
            array("val0"=>"9110","val1"=>"MT LINCOLN","val2"=>"7504000226017","val3"=>"09110","val4"=>"Av. Abraham Lincoln y Av. Santa Maria","val5"=>"Garcia "),
            array("val0"=>"2125","val1"=>"CAT MEXICO","val2"=>"7504000225010","val3"=>"10000","val4"=>"PASILLOWX,BX140C.ABASTOSIZTAPALAPCL.EJIDDELMAL C.P","val5"=>"MEXIC  "),
            array("val0"=>"2950","val1"=>"HEB MTY CHIPINQUE","val2"=>"7504000225034","val3"=>"00950","val4"=>"Gómez Morin #300Col. Valle Campestre C.P. 66265","val5"=>"San Pedro"),
            array("val0"=>"2951","val1"=>"HEB MTY CONTRY","val2"=>"7504000225041","val3"=>"00951","val4"=>"Eugenio Garza Sada #4321Col. Contry C.P. 64860","val5"=>"Monterrey"),
            array("val0"=>"2952","val1"=>"HEB MTY SAN NICOLAS","val2"=>"7504000225058","val3"=>"00952","val4"=>"Av. Universidad Norte #101Col. Anahuac C.P. 66450 ","val5"=>"San Nicolas"),
            array("val0"=>"2953","val1"=>"HEB MTY LOS MORALES","val2"=>"7504000225065","val3"=>"00953","val4"=>"F. Galvan #800Col. Hacienda los Morales C.P. 66495","val5"=>"San Nicolas"),
            array("val0"=>"2954","val1"=>"HEB SAL REPUBLICA","val2"=>"7504000225072","val3"=>"00954","val4"=>"L. Echeverria #851Col. Rep. Norte C.P. 25280","val5"=>"Saltillo"),
            array("val0"=>"2956","val1"=>"MT MTY AZTLAN","val2"=>"7504000225089","val3"=>"00956","val4"=>"Solidaridad #5151Valle del Topo Chico C.P. 64259 ","val5"=>"Monterrey"),
            array("val0"=>"2957","val1"=>"HEB MTY CHAPULTEPEC","val2"=>"7504000225096","val3"=>"00957","val4"=>"Av. Chapultepec #180Col. Paraiso C.P. 67140","val5"=>"Guadalupe"),
            array("val0"=>"2962","val1"=>"HEB MAT MATAMOROS","val2"=>"7504000225140","val3"=>"00962","val4"=>"Pedro Cardenas #1901Col. Victoria C.P. 87390","val5"=>"Matamoros"),
            array("val0"=>"2968","val1"=>"HEB NVO NUEVO LAREDO","val2"=>"7504000225195","val3"=>"00968","val4"=>"Av. Reforma #4400Col. México C.P. 88280","val5"=>"Nuevo Laredo"),
            array("val0"=>"2960","val1"=>"HEB REY MORELOS","val2"=>"7504000225126","val3"=>"00960","val4"=>"Blv. Morelos #185Prol. Longoria C.P. 88699","val5"=>"Reynosa"),
            array("val0"=>"2967","val1"=>"HEB MTY GUADALUPE JUAREZ","val2"=>"7504000225188","val3"=>"00967","val4"=>"Av. Benito Juarez #1851Col. El Sabino C.P. 67150  ","val5"=>"Guadalupe"),
            array("val0"=>"2958","val1"=>"HEB MTY LINCOLN","val2"=>"7504000225102","val3"=>"00958","val4"=>"Av Abraham Lincoln #5252Ampl. San Jorge C.P. 67150","val5"=>"Monterrey"),
            array("val0"=>"2974","val1"=>"HEB MTY ESCOBEDO","val2"=>"7504000225225","val3"=>"00974","val4"=>"Av. Raúl Salinas Lozano #297Escobedo C.P. 66055","val5"=>"General Escobedo"),
            array("val0"=>"2963","val1"=>"HEB MTY SANTA CATARINA","val2"=>"7504000225157","val3"=>"00963","val4"=>"Blv. Diaz Ordaz #108Col. Los Treviño C.P. 66150","val5"=>"Santa Catarina"),
            array("val0"=>"2976","val1"=>"HEB MTY ACAPULCO","val2"=>"7504000225249","val3"=>"00976","val4"=>"Av. Acapulco #161Fracc. Los Cristales C.P. 67117","val5"=>"Guadalupe"),
            array("val0"=>"2977","val1"=>"HEB MTY GUADALUPE LIVAS","val2"=>"7504000225256","val3"=>"00977","val4"=>"Av. Pablo Livas #7701Col. Roble Sta. Ma C.P. 67190","val5"=>"Guadalupe"),
            array("val0"=>"2959","val1"=>"HEB MTY GONZALITOS","val2"=>"7504000225119","val3"=>"00959","val4"=>"JE Gonzalez #315Col. Jardines del Cerro C.P. 64040","val5"=>"Monterrey"),
            array("val0"=>"2964","val1"=>"HEB TAM EJERCITO","val2"=>"7504000225164","val3"=>"00964","val4"=>"Ejec. Mexicano #717Col. Tampico C.P. 89120","val5"=>"Tampico"),
            array("val0"=>"2978","val1"=>"HEB MTY CUMBRES","val2"=>"7504000225263","val3"=>"00978","val4"=>"Paseo de los Leones #3399Col. Cumbres C.P. 64340","val5"=>"Monterrey"),
            array("val0"=>"2979","val1"=>"HEB MTY SENDERO","val2"=>"7504000225270","val3"=>"00979","val4"=>"Av Sendero Nte #1001Cerradas de Anahuac C.P. 66059","val5"=>"San Nicolas"),
            array("val0"=>"2986","val1"=>"HEB SLP SAN LUIS POTOSI","val2"=>"7504000225317","val3"=>"00986","val4"=>"Av. Himno Nacional #100Col. Virreyes C.P. 78240   ","val5"=>"San Luis Potosí"),
            array("val0"=>"2160","val1"=>"Cat Monterrey","val2"=>"7504000225027","val3"=>"11000","val4"=>"ANILLOPERIFERICO4001KM.28.5 C.P. 66066","val5"=>"ECBED"),
            array("val0"=>"2987","val1"=>"HEB REY LAS FUENTES","val2"=>"7504000225324","val3"=>"00987","val4"=>"Blv. Hidalgo #101Col. Las Fuentes C.P. 88710","val5"=>"Reynosa"),
            array("val0"=>"2984","val1"=>"HEB LEO LOPEZ MATEOS","val2"=>"7504000225300","val3"=>"00984","val4"=>"L. Mateos #2102Col. Jardines del Moral C.P. 37160 ","val5"=>"León"),
            array("val0"=>"2989","val1"=>"HEB SAL LA NOGALERA","val2"=>"7504000225331","val3"=>"00989","val4"=>"Prfco L. Echeverria A #1474Col. Lourdes C.P. 25070","val5"=>"Saltillo"),
            array("val0"=>"2965","val1"=>"HEB MTY SOLIDARIDAD","val2"=>"7504000225171","val3"=>"00965","val4"=>"Av. Lincoln #8000Barrio de Chapultepec C.P. 64102 ","val5"=>"Monterrey"),
            array("val0"=>"2970","val1"=>"HEB TOR INDEPENDENCIA","val2"=>"7504000225201","val3"=>"00970","val4"=>"Blv Independencia #1500 OteCol. Navarro C.P. 27010","val5"=>"Torreón"),
            array("val0"=>"2981","val1"=>"HEB MTY VALLE ALTO","val2"=>"7504000225294","val3"=>"00981","val4"=>"Carr Nacional Km 270Lomas de Valle Alto C.P. 64989","val5"=>"Monterrey"),
            array("val0"=>"2975","val1"=>"HEB MTY SAN PEDRO","val2"=>"7504000225232","val3"=>"00975","val4"=>"Calzada del Valle #601 PteCol Del Valle C.P. 66220","val5"=>"San Pedro"),
            array("val0"=>"2972","val1"=>"MT REY RIO BRAVO ","val2"=>"7504000225218","val3"=>"00972","val4"=>"Fco. I Madero #2000Col. La Paz C.P. 88811","val5"=>"Río Bravo"),
            array("val0"=>"2961","val1"=>"HEB MTY LINDA VISTA","val2"=>"7504000225133","val3"=>"00961","val4"=>"Av. Miguel Alemán #5050Col. Libertad C.P. 67130","val5"=>"Guadalupe"),
            array("val0"=>"2980","val1"=>"HEB MTY CONCORDIA","val2"=>"7504000225287","val3"=>"00980","val4"=>"Carr Mezquital Sta Rosa #5000Sta Rosa C.P. 66610","val5"=>"Apodaca"),
            array("val0"=>"2971","val1"=>"HEB PIE PIEDRAS NEGRAS","val2"=>"7504000225355","val3"=>"00971","val4"=>"Libr. Manuel Perez Treviño #401San Luis C.P. 26040","val5"=>"Piedras Negras"),
            array("val0"=>"2966","val1"=>"MT MTY SAN ROQUE","val2"=>"7504000225393","val3"=>"00966","val4"=>"Carr. Mty-Reynosa #600Col. Coahuila C.P. 67257","val5"=>"Benito Juárez"),
            array("val0"=>"2994","val1"=>"MT MTY HUINALA","val2"=>"7504000225362","val3"=>"00994","val4"=>"Gaspar Castaño #101Lomas del Pedregal C.P. 66648","val5"=>"Apodaca"),
            array("val0"=>"2990","val1"=>"MT MTY CIUDADELA","val2"=>"7504000225386","val3"=>"00990","val4"=>"Lic. Arturo de la Garza #101Col. Juárez C.P. 67266","val5"=>"Benito Juárez"),
            array("val0"=>"2969","val1"=>"MT REY PERIFERICO","val2"=>"7504000225348","val3"=>"00969","val4"=>"Libramiento Sur #4000Col. LR Jarachinas C.P. 88730","val5"=>"Reynosa"),
            array("val0"=>"2920","val1"=>"MT MTY ZUAZUA","val2"=>"7504000225379","val3"=>"00920","val4"=>"Carr. Zuazua #131Col. Real de Palmas C.P. 65760","val5"=>"Zuazua "),
            array("val0"=>"2996","val1"=>"HEB MTY VALLE ORIENTE","val2"=>"7504000225409","val3"=>"00996","val4"=>"Fundadores #101Valle Ote. San Pedro C.P. 66269","val5"=>"San Pedro"),
            array("val0"=>"2922","val1"=>"HEB SLP CARRETERA 57","val2"=>"7504000225638","val3"=>"00922","val4"=>"AV. BENITO JUAREZ #1272FRACC. VALLE DORADO CARRETE","val5"=>"SAN LUIS POTOSI"),
            array("val0"=>"2973","val1"=>"HEB TAM HIDALGO","val2"=>"7504000225416","val3"=>"00973","val4"=>"Ave. Hidalgo #6313Col Choferes C.P. 89337","val5"=>"Tampico"),
            array("val0"=>"2928","val1"=>"HEB VIC CAMPESTRE","val2"=>"7504000225430","val3"=>"00928","val4"=>"Carr Nal. Tams #2850Adolfo López Mateos C.P. 87020","val5"=>"Victoria"),
            array("val0"=>"2927","val1"=>"HEB MVA PAPE","val2"=>"7504000225423","val3"=>"00927","val4"=>"Bulevar Harold R. Pape #1912Del Prado C.P. 25730","val5"=>"Monclova"),
            array("val0"=>"2931","val1"=>"MT REY BUGAMBILIAS","val2"=>"7504000225522","val3"=>"00931","val4"=>"Avenida Hacienda las Bugambilias #100Hacienda Las ","val5"=>"Reynosa"),
            array("val0"=>"2939","val1"=>"MT MTY VALLE DE SANTA MARIA","val2"=>"7504000225652","val3"=>"00939","val4"=>"San Fernando #300Valle de Santa María C.P. 66693","val5"=>"Pesquería"),
            array("val0"=>"9071","val1"=>"CAT MTY SECOS","val2"=>"7504000225027","val3"=>"00939","val4"=>"ANILLOPERIFERICO4001KM.28.5 C.P. 66066","val5"=>"Monterrey"),
            array("val0"=>"9101","val1"=>"CAT MTY FRESCOS","val2"=>"7504000225027","val3"=>"00939","val4"=>"ANILLOPERIFERICO4001KM.28.5 C.P. 66066","val5"=>"Monterrey"),
            array("val0"=>"9106","val1"=>"HEB MTY DIEGO DIAZ","val2"=>"7504000225973","val3"=>"09106","val4"=>"DIEGO DIAZ DE BERLANGA 469JARDINES DE SANTO DOMING","val5"=>"San Nicolas"),
        );

        $walmart_branches = array(
            array("branch_number" => 4188, "name" => "Mer", "city" => "Merida"),
            array("branch_number" => 4640, "name" => "Chihua", "city" => "Chihuahua"),
            array("branch_number" => 4924, "name" => "Mxl", "city" => "Mexicali"),
            array("branch_number" => 7468, "name" => "Vhs", "city" => "Villahermosa"),
            array("branch_number" => 7487, "name" => "Cln", "city" => "Culiacan"),
            array("branch_number" => 7490, "name" => "Mty", "city" => "Monterrey"),
            array("branch_number" => 7493, "name" => "Gdl", "city" => "Guadalajara"),
            array("branch_number" => 7464, "name" => "La luz", "city" => "La luz"),
            array("branch_number" => 7471, "name" => "Chalco", "city" => "Chalco"),
        );

        foreach($walmart_branches as $key => $branch){
            Branch::create([
                "client_id" => 2,
                "branch_number" => $branch['branch_number'],
                "name" => $branch['name'],
                "gln" => 0,
                "address" => "",
                "city" => $branch['city'],
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),        
            ]);
        }

        foreach ($table_branches as $key => $branch) {            
            Branch::create([
                "client_id" => 1,
                "branch_number" => $branch['val0'],
                "name" => $branch['val1'],
                "gln" => $branch['val2'],
                "address" => $branch['val4'],
                "city" => $branch['val5'],
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
