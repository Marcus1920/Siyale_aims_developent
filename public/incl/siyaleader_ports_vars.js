// (C) Copyright 2015 - Rupert Meyer <rupert@cooluma.co.za> - All Rights Reserved

var map;
var SA = new google.maps.LatLng(-30.326385, 24.188828);
var DBN = new google.maps.LatLng(-29.881651, 30.989003);
var RB = new google.maps.LatLng(-28.807896, 32.041361);
var EL  = new google.maps.LatLng(-33.025901, 27.883711);
var NG = new google.maps.LatLng(-33.766334, 25.667147);
var PE = new google.maps.LatLng(-33.960700, 25.618584);
var MOS = new google.maps.LatLng(-34.178028, 22.140478);
var CT = new google.maps.LatLng(-33.910667, 18.440199);
var SAL =new  google.maps.LatLng(-33.048716, 18.005201);
var allLocalityOverlayStatus = 0;
var purpleLocalityOverlayStatus = 0;
var pinkLocalityOverlayStatus = 0;
var orangeLocalityOverlayStatus = 0;
var greenLocalityOverlayStatus = 0;
var yellowLocalityOverlayStatus = 0;
var blueLocalityOverlayStatus = 0;
var markerLegendStatus = 0;
var zoneListener;
var selectZoneArray = 0;
var portsMenu = 0;
var mainMenu = 0;
var layerMenu = 0;
var ruSureStatus = 0;
var allMarkers = 1;
var photoFrameDown = 0;
var cmcFrameDown = 0;
var newCaseMarkerStatus = 0;
var newCaseImage = "markers/newCaseMarker.png";
var portAssetsOverlay;
var mcOptions = "";
var captureIframe;
var capture_map_center;
var capture_map_zoom;
var iframeDoc;
var markerNew;
var markerCluster;
var menuSelection;	
var photoRotation = "0deg";
var mcStatus = meStatus = mmStatus = hkStatus = trStatus = prStatus = poStatus = seStatus = srStatus = heStatus = maStatus = enStatus = 1;
var mcPenRadioStatus =  mcAllRadioStatus =  mcRefRadioStatus =  mcActRadioStatus =  mcCloRadioStatus =  mcResRadioStatus =  mePenRadioStatus =  meAllRadioStatus =  meRefRadioStatus =  meActRadioStatus =  meCloRadioStatus =  meResRadioStatus =  mmPenRadioStatus =  mmAllRadioStatus =  mmRefRadioStatus =  mmActRadioStatus =  mmCloRadioStatus =  mmResRadioStatus =  hkPenRadioStatus =  hkAllRadioStatus =  hkRefRadioStatus =  hkActRadioStatus =  hkCloRadioStatus =  hkResRadioStatus =  trPenRadioStatus =  trAllRadioStatus =  trRefRadioStatus =  trActRadioStatus =  trCloRadioStatus =  trResRadioStatus = enPenRadioStatus =  enAllRadioStatus =  enRefRadioStatus =  enActRadioStatus =  enCloRadioStatus =  enResRadioStatus = hePenRadioStatus =  heAllRadioStatus =  heRefRadioStatus =  heActRadioStatus =  heCloRadioStatus =  heResRadioStatus = maPenRadioStatus =  maAllRadioStatus =  maRefRadioStatus =  maActRadioStatus =  maCloRadioStatus =  maResRadioStatus = poPenRadioStatus =  poAllRadioStatus =  poRefRadioStatus =  poActRadioStatus =  poCloRadioStatus =  poResRadioStatus = prPenRadioStatus =  prAllRadioStatus =  prRefRadioStatus =  prActRadioStatus =  prCloRadioStatus =  prResRadioStatus = sePenRadioStatus =  seAllRadioStatus =  seRefRadioStatus =  seActRadioStatus = seCloRadioStatus =  seResRadioStatus = srPenRadioStatus =  srAllRadioStatus =  srRefRadioStatus =  srActRadioStatus =  srCloRadioStatus =  srResRadioStatus = 1;
var mcPenStatus = mcAllStatus = mcRefStatus = mcActStatus = mcCloStatus = mcResStatus = mePenStatus = meAllStatus = meRefStatus = meActStatus = meCloStatus = meResStatus = mmPenStatus = mmAllStatus = mmRefStatus = mmActStatus = mmCloStatus = mmResStatus = hkPenStatus = hkAllStatus = hkRefStatus = hkActStatus = hkCloStatus = hkResStatus = trPenStatus = trAllStatus = trRefStatus = trActStatus = trCloStatus = trResStatus = enPenStatus = enAllStatus = enRefStatus = enActStatus = enCloStatus = enResStatus = hePenStatus = heAllStatus = heRefStatus = heActStatus = heCloStatus = heResStatus = maPenStatus = maAllStatus = maRefStatus = maActStatus = maCloStatus = maResStatus = poPenStatus = poAllStatus = poRefStatus = poActStatus = poCloStatus = poResStatus = sePenStatus = seAllStatus = seRefStatus = seActStatus = seCloStatus = seResStatus = srPenStatus = srAllStatus = srRefStatus = srActStatus = srCloStatus = srResStatus = prPenStatus = prAllStatus = prRefStatus = prActStatus = prCloStatus = prResStatus = 1;
var statusArray = ["Pen","All","Ref","Act","Clo","Res"];
var catArray = ["mc","me","mm","hk","tr","en","he","ma","po","se","sr","pr"];
var localityOverlay = ["purple","pink","orange","green","yellow","blue"];
var dbnEightMilePolly;
var zoneArrayMarkers = [];
var markers = [];
var shipMarkers = [];
var co_ords = [];
var shipCoords = [];
var infoBoxArray = [];
var shipInfoBoxArray = [];
var mcArray = [];  // Maintenance (Civil) ...
var meArray = [];  // Maintenance (Electrical)
var mmArray = [];  // Maintenance (Marine)
var hkArray = [];  // Housekeeping
var trArray = [];  // Traffic Management
var prArray = [];  // Property
var heArray = [];  // Health
var maArray = [];  // Maintenance (Mechanical)
var poArray = [];  // Ports Ops Centre
var seArray = [];  // Security
var srArray = [];  // Safety Risk
var enArray = [];  // Environment
var prPenArray = [];
var prAllArray = [];
var prRefArray = [];
var prActArray = [];
var prCloArray = [];
var prResArray = [];
var hePenArray = [];
var heAllArray = [];
var heRefArray = [];
var heActArray = [];
var heCloArray = [];
var heResArray = [];
var maPenArray = [];
var maAllArray = [];
var maRefArray = [];
var maActArray = [];
var maCloArray = [];
var maResArray = [];
var poPenArray = [];
var poAllArray = [];
var poRefArray = [];
var poActArray = [];
var poCloArray = [];
var poResArray = [];
var sePenArray = [];
var seAllArray = [];
var seRefArray = [];
var seActArray = [];
var seCloArray = [];
var seResArray = [];
var srPenArray = [];
var srAllArray = [];
var srRefArray = [];
var srActArray = [];
var srCloArray = [];
var srResArray = [];
var enPenArray = [];
var enAllArray = [];
var enRefArray = [];
var enActArray = [];
var enCloArray = [];
var enResArray = [];
var mcPenArray = [];
var mcAllArray = [];
var mcRefArray = [];
var mcActArray = [];
var mcCloArray = [];
var mcResArray = [];
var mePenArray = [];
var meAllArray = [];
var meRefArray = [];
var meActArray = [];
var meCloArray = [];
var meResArray = [];
var mmPenArray = [];
var mmAllArray = [];
var mmRefArray = [];
var mmActArray = [];
var mmCloArray = [];
var mmResArray = [];
var hkPenArray = [];
var hkAllArray = [];
var hkRefArray = [];
var hkActArray = [];
var hkCloArray = [];
var hkResArray = [];
var trPenArray = [];
var trAllArray = [];
var trRefArray = [];
var trActArray = [];
var trCloArray = [];
var trResArray = [];

var dbnEightMilePollyCoords = [
new google.maps.LatLng(-29.86546544588216, 31.06430411338806),
new google.maps.LatLng(-29.865139804826146, 31.064014434814453),
new google.maps.LatLng(-29.86618185246443, 31.062512397766113),
new google.maps.LatLng(-29.86655400969783, 31.06206178665161),
new google.maps.LatLng(-29.868489204934694, 31.06038808822632),
new google.maps.LatLng(-29.869438181189764, 31.059798002243042),
new google.maps.LatLng(-29.869494003041307, 31.0598623752594),
new google.maps.LatLng(-29.872247842270284, 31.058671474456787),
new google.maps.LatLng(-29.873261905807706, 31.057780981063843),
new google.maps.LatLng(-29.873447971392494, 31.057287454605103),
new google.maps.LatLng(-29.873466577931875, 31.05663299560547),
new google.maps.LatLng(-29.875401639077573, 31.055163145065308),
new google.maps.LatLng(-29.875773761917053, 31.05434775352478),
new google.maps.LatLng(-29.879318162368296, 31.051021814346313),
new google.maps.LatLng(-29.88157869843802, 31.048908233642578),
new google.maps.LatLng(-29.884527551177772, 31.04609727859497),
new google.maps.LatLng(-29.884108949633372, 31.045764684677124),
new google.maps.LatLng(-29.883978717683352, 31.04608654975891),
new google.maps.LatLng(-29.88368104401595, 31.04638695716858),
new google.maps.LatLng(-29.883485695188735, 31.046290397644043),
new google.maps.LatLng(-29.88426708820116, 31.044541597366333),
new google.maps.LatLng(-29.884211274617634, 31.044423580169678),
new google.maps.LatLng(-29.88678796914771, 31.038469076156616),
new google.maps.LatLng(-29.886555418223708, 31.038297414779663),
new google.maps.LatLng(-29.88808094239235, 31.034789085388184),
new google.maps.LatLng(-29.888183263299968, 31.03485345840454),
new google.maps.LatLng(-29.888490225392673, 31.03413462638855),
new google.maps.LatLng(-29.888601847737487, 31.034220457077026),
new google.maps.LatLng(-29.888825092052155, 31.033962965011597),
new google.maps.LatLng(-29.891597000648353, 31.02760076522827),
new google.maps.LatLng(-29.891559794331947, 31.027225255966187),
new google.maps.LatLng(-29.89149468324481, 31.02711796760559),
new google.maps.LatLng(-29.88941110599949, 31.025948524475098),
new google.maps.LatLng(-29.888825092052155, 31.025841236114502),
new google.maps.LatLng(-29.887932111793788, 31.026195287704468),
new google.maps.LatLng(-29.88437871527445, 31.0293710231781),
new google.maps.LatLng(-29.884369413023112, 31.029714345932007),
new google.maps.LatLng(-29.88426708820116, 31.029950380325317),
new google.maps.LatLng(-29.88463917795946, 31.030497550964355),
new google.maps.LatLng(-29.884750804616164, 31.031012535095215),
new google.maps.LatLng(-29.88525312302475, 31.03466033935547),
new google.maps.LatLng(-29.885215914340538, 31.034939289093018),
new google.maps.LatLng(-29.8848624311479, 31.035507917404175),
new google.maps.LatLng(-29.884434528764224, 31.03713870048523),
new google.maps.LatLng(-29.88236940883392, 31.041784286499023),
new google.maps.LatLng(-29.880918217889434, 31.0409152507782),
new google.maps.LatLng(-29.881420555606418, 31.03965997695923),
new google.maps.LatLng(-29.88051820641605, 31.03910207748413),
new google.maps.LatLng(-29.880862402431344, 31.03838324546814),
new google.maps.LatLng(-29.88175544601182, 31.038898229599),
new google.maps.LatLng(-29.882704296052573, 31.036816835403442),
new google.maps.LatLng(-29.88152288334962, 31.03611946105957),
new google.maps.LatLng(-29.88130892522134, 31.035969257354736),
new google.maps.LatLng(-29.881355437896975, 31.035540103912354),
new google.maps.LatLng(-29.881392648021865, 31.035196781158447),
new google.maps.LatLng(-29.881057756397993, 31.03487491607666),
new google.maps.LatLng(-29.8809368230352, 31.034724712371826),
new google.maps.LatLng(-29.88115078196188, 31.033694744110107),
new google.maps.LatLng(-29.881243807439, 31.033716201782227),
new google.maps.LatLng(-29.88184847092485, 31.031076908111572),
new google.maps.LatLng(-29.881634513495168, 31.031055450439453),
new google.maps.LatLng(-29.876127277328568, 31.0333514213562),
new google.maps.LatLng(-29.876834304392503, 31.029746532440186),
new google.maps.LatLng(-29.88262987676786, 31.027268171310425),
new google.maps.LatLng(-29.883746160206627, 31.021807193756104),
new google.maps.LatLng(-29.878043681171988, 31.02413535118103),
new google.maps.LatLng(-29.877727384045865, 31.02385640144348),
new google.maps.LatLng(-29.877848321300778, 31.023201942443848),
new google.maps.LatLng(-29.87807158969377, 31.023266315460205),
new google.maps.LatLng(-29.87989492952704, 31.014082431793213),
new google.maps.LatLng(-29.879615849060322, 31.013964414596558),
new google.maps.LatLng(-29.879066988530703, 31.01417899131775),
new google.maps.LatLng(-29.878555336163878, 31.012505292892456),
new google.maps.LatLng(-29.878592547333607, 31.012108325958252),
new google.maps.LatLng(-29.87884372236617, 31.01163625717163),
new google.maps.LatLng(-29.87925304328596, 31.011357307434082),
new google.maps.LatLng(-29.881429858132865, 31.011089086532593),
new google.maps.LatLng(-29.88214615006329, 31.01119637489319),
new google.maps.LatLng(-29.882769412881153, 31.010971069335938),
new google.maps.LatLng(-29.883578718487517, 31.010080575942993),
new google.maps.LatLng(-29.88386709016221, 31.009812355041504),
new google.maps.LatLng(-29.884397319774514, 31.009758710861206),
new google.maps.LatLng(-29.884908942165907, 31.010091304779053),
new google.maps.LatLng(-29.886667042734924, 31.011486053466797),
new google.maps.LatLng(-29.88710423753381, 31.01165771484375),
new google.maps.LatLng(-29.888006527120847, 31.01216197013855),
new google.maps.LatLng(-29.888992524960074, 31.011282205581665),
new google.maps.LatLng(-29.889643650261895, 31.011089086532593),
new google.maps.LatLng(-29.890118038875062, 31.0114324092865),
new google.maps.LatLng(-29.89015524572963, 31.01168990135193),
new google.maps.LatLng(-29.89052731351153, 31.011550426483154),
new google.maps.LatLng(-29.890759855169957, 31.011786460876465),
new google.maps.LatLng(-29.890871474973306, 31.01170063018799),
new google.maps.LatLng(-29.890666838571686, 31.011507511138916),
new google.maps.LatLng(-29.890769156825005, 31.011357307434082),
new google.maps.LatLng(-29.89097379301658, 31.011464595794678),
new google.maps.LatLng(-29.89273178662713, 31.011207103729248),
new google.maps.LatLng(-29.892759691037632, 31.010520458221436),
new google.maps.LatLng(-29.892573661486782, 31.009984016418457),
new google.maps.LatLng(-29.89063893357528, 31.01069211959839),
new google.maps.LatLng(-29.890164547441103, 31.010595560073853),
new google.maps.LatLng(-29.889922702660705, 31.010338068008423),
new google.maps.LatLng(-29.889838987023094, 31.009576320648193),
new google.maps.LatLng(-29.889950607857614, 31.009329557418823),
new google.maps.LatLng(-29.890276167911082, 31.00916862487793),
new google.maps.LatLng(-29.891392365736237, 31.008739471435547),
new google.maps.LatLng(-29.891755127338154, 31.008460521697998),
new google.maps.LatLng(-29.894685076494465, 31.007280349731445),
new google.maps.LatLng(-29.894638570037742, 31.007065773010254),
new google.maps.LatLng(-29.89528965845695, 31.006765365600586),
new google.maps.LatLng(-29.89569891185757, 31.006593704223633),
new google.maps.LatLng(-29.89592214027683, 31.00662589073181),
new google.maps.LatLng(-29.896647629186102, 31.006540060043335),
new google.maps.LatLng(-29.897680046604766, 31.005971431732178),
new google.maps.LatLng(-29.89795907650345, 31.005778312683105),
new google.maps.LatLng(-29.898256707534205, 31.005821228027344),
new google.maps.LatLng(-29.898517133956883, 31.006003618240356),
new google.maps.LatLng(-29.89985645909373, 31.006861925125122),
new google.maps.LatLng(-29.903576712238035, 31.009243726730347),
new google.maps.LatLng(-29.90414403863502, 31.008996963500977),
new google.maps.LatLng(-29.904395149287474, 31.00862145423889),
new google.maps.LatLng(-29.905036873634735, 31.008814573287964),
new google.maps.LatLng(-29.905018272987192, 31.008557081222534),
new google.maps.LatLng(-29.90448815307219, 31.008342504501343),
new google.maps.LatLng(-29.903725519474403, 31.00744128227234),
new google.maps.LatLng(-29.902683864152248, 31.006497144699097),
new google.maps.LatLng(-29.902246737692607, 31.006743907928467),
new google.maps.LatLng(-29.89927980742221, 31.00466251373291),
new google.maps.LatLng(-29.89890777231472, 31.00417971611023),
new google.maps.LatLng(-29.8998192558608, 31.003718376159668),
new google.maps.LatLng(-29.90074003179347, 31.002752780914307),
new google.maps.LatLng(-29.901828210561714, 31.001561880111694),
new google.maps.LatLng(-29.902367645203118, 31.000553369522095),
new google.maps.LatLng(-29.90303728414299, 30.9988796710968),
new google.maps.LatLng(-29.902562957025506, 30.99864363670349),
new google.maps.LatLng(-29.9016421979392, 31.00088596343994),
new google.maps.LatLng(-29.901167864179932, 31.001465320587158),
new google.maps.LatLng(-29.899623938659975, 31.003117561340332),
new google.maps.LatLng(-29.898535735818175, 31.003621816635132),
new google.maps.LatLng(-29.89847062928847, 31.00345015525818),
new google.maps.LatLng(-29.897903270586223, 31.00341796875),
new google.maps.LatLng(-29.897010371660148, 31.003750562667847),
new google.maps.LatLng(-29.89749402623824, 31.00270986557007),
new google.maps.LatLng(-29.897382413851652, 31.002624034881592),
new google.maps.LatLng(-29.89678714567853, 31.003847122192383),
new google.maps.LatLng(-29.896070958945206, 31.00416898727417),
new google.maps.LatLng(-29.888053036672048, 31.007505655288696),
new google.maps.LatLng(-29.887801884837785, 31.005992889404297),
new google.maps.LatLng(-29.887671657711646, 31.00590705871582),
new google.maps.LatLng(-29.887615846034105, 31.005467176437378),
new google.maps.LatLng(-29.88765305382261, 31.00519895553589),
new google.maps.LatLng(-29.8876344499301, 31.00488781929016),
new google.maps.LatLng(-29.887978621379705, 31.00465178489685),
new google.maps.LatLng(-29.887894904109427, 31.00445866584778),
new google.maps.LatLng(-29.887504222585243, 31.00467324256897),
new google.maps.LatLng(-29.887439108849012, 31.004329919815063),
new google.maps.LatLng(-29.88762514798253, 31.004287004470825),
new google.maps.LatLng(-29.887485618664947, 31.004040241241455),
new google.maps.LatLng(-29.887327485202256, 31.003825664520264),
new google.maps.LatLng(-29.887411202949046, 31.003514528274536),
new google.maps.LatLng(-29.88721586143053, 31.00239872932434),
new google.maps.LatLng(-29.887383297041257, 31.002237796783447),
new google.maps.LatLng(-29.889085543120736, 31.00143313407898),
new google.maps.LatLng(-29.888359999165754, 30.9993839263916),
new google.maps.LatLng(-29.886899593398542, 31.000027656555176),
new google.maps.LatLng(-29.8864530956453, 30.998740196228027),
new google.maps.LatLng(-29.88784839448445, 30.998021364212036),
new google.maps.LatLng(-29.887383297041257, 30.996272563934326),
new google.maps.LatLng(-29.88731818322606, 30.996036529541016),
new google.maps.LatLng(-29.88734608915208, 30.99568247795105),
new google.maps.LatLng(-29.885383353310147, 30.995328426361084),
new google.maps.LatLng(-29.885811251621593, 30.991530418395996),
new google.maps.LatLng(-29.885448468389054, 30.9914767742157),
new google.maps.LatLng(-29.88501126632913, 30.995264053344727),
new google.maps.LatLng(-29.88465778241092, 30.99521040916443),
new google.maps.LatLng(-29.88338336945984, 31.00367546081543),
new google.maps.LatLng(-29.878080892532637, 31.005992889404297),
new google.maps.LatLng(-29.873596823610416, 31.007859706878662),
new google.maps.LatLng(-29.8733828484773, 31.008052825927734),
new google.maps.LatLng(-29.867986802086453, 31.013267040252686),
new google.maps.LatLng(-29.867261104617, 31.012730598449707),
new google.maps.LatLng(-29.867270408464115, 31.01292371749878),
new google.maps.LatLng(-29.867772814919856, 31.01362109184265),
new google.maps.LatLng(-29.86808914361259, 31.013739109039307),
new google.maps.LatLng(-29.868535723588984, 31.014704704284668),
new google.maps.LatLng(-29.86847059746692, 31.014779806137085),
new google.maps.LatLng(-29.86804262475009, 31.013803482055664),
new google.maps.LatLng(-29.86783794149741, 31.013717651367188),
new google.maps.LatLng(-29.867335535369623, 31.015573740005493),
new google.maps.LatLng(-29.867261104617, 31.01564884185791),
new google.maps.LatLng(-29.86646097051962, 31.01538062095642),
new google.maps.LatLng(-29.86615394061596, 31.017054319381714),
new google.maps.LatLng(-29.86657261752307, 31.01715087890625),
new google.maps.LatLng(-29.86676799947847, 31.01617455482483),
new google.maps.LatLng(-29.866935469421453, 31.01615309715271),
new google.maps.LatLng(-29.866674960499807, 31.017225980758667),
new google.maps.LatLng(-29.86608881293918, 31.017472743988037),
new google.maps.LatLng(-29.865288669440762, 31.017279624938965),
new google.maps.LatLng(-29.863437149999847, 31.019833087921143),
new google.maps.LatLng(-29.86345575840634, 31.020326614379883),
new google.maps.LatLng(-29.86369766737495, 31.021045446395874),
new google.maps.LatLng(-29.863837229974695, 31.021442413330078),
new google.maps.LatLng(-29.86403261728639, 31.0214102268219),
new google.maps.LatLng(-29.864209395953043, 31.021517515182495),
new google.maps.LatLng(-29.86547474989671, 31.024006605148315),
new google.maps.LatLng(-29.865511965946247, 31.024188995361328),
new google.maps.LatLng(-29.865353797639816, 31.024725437164307),
new google.maps.LatLng(-29.864897899353718, 31.02466106414795),
new google.maps.LatLng(-29.864972331869243, 31.024199724197388),
new google.maps.LatLng(-29.86461877692603, 31.02363109588623),
new google.maps.LatLng(-29.864395478421706, 31.023749113082886),
new google.maps.LatLng(-29.862999851448343, 31.02087378501892),
new google.maps.LatLng(-29.86288820044724, 31.020970344543457),
new google.maps.LatLng(-29.86257185526572, 31.02165699005127),
new google.maps.LatLng(-29.86246020378575, 31.022568941116333),
new google.maps.LatLng(-29.862115944269462, 31.02260112762451),
new google.maps.LatLng(-29.86210663994173, 31.022740602493286),
new google.maps.LatLng(-29.86257185526572, 31.022804975509644),
new google.maps.LatLng(-29.862655593793722, 31.02290153503418),
new google.maps.LatLng(-29.862646289516306, 31.023437976837158),
new google.maps.LatLng(-29.862785853586484, 31.023577451705933),
new google.maps.LatLng(-29.862609072397948, 31.02386713027954),
new google.maps.LatLng(-29.86257185526572, 31.02487564086914),
new google.maps.LatLng(-29.86232063926012, 31.024972200393677),
new google.maps.LatLng(-29.862329943567914, 31.025068759918213),
new google.maps.LatLng(-29.862562550980506, 31.02516531944275),
new google.maps.LatLng(-29.862655593793722, 31.02536916732788),
new google.maps.LatLng(-29.86246020378575, 31.025540828704834),
new google.maps.LatLng(-29.862004292279398, 31.025465726852417),
new google.maps.LatLng(-29.861911248858924, 31.02742910385132),
new google.maps.LatLng(-29.862525333830927, 31.0278582572937),
new google.maps.LatLng(-29.862823070638914, 31.02816939353943),
new google.maps.LatLng(-29.863399933176453, 31.02811574935913),
new google.maps.LatLng(-29.864181483552812, 31.02884531021118),
new google.maps.LatLng(-29.86414426700703, 31.029027700424194),
new google.maps.LatLng(-29.863874446634988, 31.028834581375122),
new google.maps.LatLng(-29.863213848851274, 31.02837324142456),
new google.maps.LatLng(-29.86292541746149, 31.02840542793274),
new google.maps.LatLng(-29.862153161571722, 31.028459072113037),
new google.maps.LatLng(-29.862088031283655, 31.03114128112793),
new google.maps.LatLng(-29.86476764231796, 31.03415608406067),
new google.maps.LatLng(-29.870163862823464, 31.0323965549469),
new google.maps.LatLng(-29.871773368634646, 31.034220457077026),
new google.maps.LatLng(-29.868433382520948, 31.0353684425354),
new google.maps.LatLng(-29.868545027317232, 31.03585124015808),
new google.maps.LatLng(-29.874731814467808, 31.042696237564087),
new google.maps.LatLng(-29.87305723326356, 31.04459524154663),
new google.maps.LatLng(-29.874238746255735, 31.05064630508423),
new google.maps.LatLng(-29.87390383060838, 31.050678491592407),
new google.maps.LatLng(-29.873848011224492, 31.05111837387085),
new google.maps.LatLng(-29.870749986443204, 31.05382204055786),
new google.maps.LatLng(-29.869801022666454, 31.05462670326233),
new google.maps.LatLng(-29.869773111830483, 31.053671836853027),
new google.maps.LatLng(-29.869047427354413, 31.051944494247437),
new google.maps.LatLng(-29.867856549083182, 31.048972606658936),
new google.maps.LatLng(-29.86635862732337, 31.046762466430664),
new google.maps.LatLng(-29.86433034959714, 31.044949293136597),
new google.maps.LatLng(-29.861101767440417, 31.043071746826172),
new google.maps.LatLng(-29.85364399470017, 31.040539741516113),
new google.maps.LatLng(-29.845827390358803, 31.03762149810791),
new google.maps.LatLng(-29.836316363282766, 31.03708505630493),
new google.maps.LatLng(-29.821145238723236, 31.038436889648438),
new google.maps.LatLng(-29.8073868539586, 31.042213439941406),
new google.maps.LatLng(-29.797332168780677, 31.046290397644043),
new google.maps.LatLng(-29.785004490809822, 31.052298545837402),
new google.maps.LatLng(-29.769583445322564, 31.060774326324463),
new google.maps.LatLng(-29.756991555717292, 31.069529056549072),
new google.maps.LatLng(-29.756991555717292, 31.069529056549072),
new google.maps.LatLng(-29.76017693175006, 31.068992614746094),
new google.maps.LatLng(-29.76221663690815, 31.090450286865234),
new google.maps.LatLng(-29.767730152612145, 31.113624572753906),
new google.maps.LatLng(-29.778756273662072, 31.138858795166016),
new google.maps.LatLng(-29.79499524074253, 31.1627197265625),
new google.maps.LatLng(-29.811976295564243, 31.179370880126953),
new google.maps.LatLng(-29.84503639034939, 31.196537017822266),
new google.maps.LatLng(-29.87228040410369, 31.201171875),
new google.maps.LatLng(-29.89639184844267, 31.199798583984375),
new google.maps.LatLng(-29.92243160853021, 31.190528869628906),
new google.maps.LatLng(-29.94310976574711, 31.177310943603516),
new google.maps.LatLng(-29.96185028090806, 31.157569885253906),
new google.maps.LatLng(-29.975977698465304, 31.135597229003906),
new google.maps.LatLng(-29.986534772505884, 31.110191345214844),
new google.maps.LatLng(-29.992779273908134, 31.075515747070312),
new google.maps.LatLng(-29.98935971464742, 31.02367401123047),
new google.maps.LatLng(-29.980289878364832, 30.995521545410156),
new google.maps.LatLng(-29.97181403679449, 30.978012084960938),
new google.maps.LatLng(-29.903237244898218, 31.040668487548828),
new google.maps.LatLng(-29.886867036338298, 31.053199768066406),
new google.maps.LatLng(-29.87615053487751, 31.061267852783203),
new google.maps.LatLng(-29.870791852284277, 31.060924530029297),
new google.maps.LatLng(-29.86546544588216, 31.06430411338806)
];


