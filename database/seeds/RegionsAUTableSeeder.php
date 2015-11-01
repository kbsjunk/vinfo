<?php

use Vinfo\Region;

class RegionsAUTableSeeder extends RegionsTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$country = Region::whereTranslation('name', 'Australia', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();
		
		$regions = [];
		$depths  = [2, 6, 7, 8];

		$sa  = 'en:South Australia|de:Südaustralien|fr:Australie-Méridionale|es:Australia Meridional|it:Australia Meridionale|ru:Южная Австралия|zh:南澳大利亚州';
		$nsw = 'en:New South Wales|de:Neusüdwales|fr:Nouvelle-Galles du Sud|es:Nueva Gales del Sur|it:Nuovo Gales del Sud|zh:新南威尔士州|ru:Новый Южный Уэльс';
		$wa  = 'en:Western Australia|de:Westaustralien|fr:Australie-Occidentale|zh:西澳大利亚州|ru:Западная Австралия|es:Australia Occidental|it:Australia Occidentale';
		$qld = 'en:Queensland|zh:昆士兰州|ru:Квинсленд';
		$vic = 'en:Victoria|ru:Виктория|zh:维多利亚州';
		$tas = 'en:Tasmania|zh:塔斯马尼亚州|fr:Tasmanie|ru:Тасмания|de:Tasmanien';
		$nt  = 'en:Northern Territory|es:Territorio del Norte|it:Territorio del Nord|zh:北领地|ru:Северная территория|de:Nordterritorium';
		$act = 'en:Australian Capital Territory|de:Australisches Hauptstadtterritorium|es:Territorio de la Capital Australiana|it:Territorio della Capitale Australiana|zh:澳大利亚首都领地|ru:Австралийская столичная территория';

		$adelaide           = 'en:Adelaide|fr:Adélaïde|es:Adelaida|zh:阿德莱德';
		$hunterValley       = 'en:Hunter Valley|es:Valle de Hunter|it:Valle de Hunter|fr:Vallée Hunter';
		$barossaValley      = 'en:Barossa Valley|es:Valle de Barossa|it:Valle de Barossa|fr:Vallée Barossa|ru:Долина Баросса|zh:巴罗莎山谷';
		$barossa            = 'en:Barossa|ru:Баросса|zh:巴罗莎';
		
		$southWestAustralia = 'en:South West Australia|de:Südwestaustralien|zh:澳大利亚西南部|es:Suroeste de Australia|fr:Sud-ouest de l\'Australie|ru:Юго-западная Австралия';
		$southernNsw        = 'en:Southern New South Wales|de:Südliches Neusüdwales|fr:Partie sud de la Nouvelle-Galles du Sud|es:Parte sur de Nueva Gales del Sur|it:Parte sur de Nueva Gales del Sur|zh:新南威尔士州南部';
		$centralVictoria    = 'en:Central Victoria|zh:维多利亚州中部|ru:Центральный Виктория|de:Zentral-Victoria|fr:Centre de Victoria';
		$northEastVictoria  = 'en:North East Victoria|zh:维多利亚州东北部|ru:Северо-восточный Виктория|de:Nordost-Victoria|fr:Partie nord-est de Victoria|es:Parte noreste de Victoria|it:Parte nord-orientale de Victoria';
		$northWestVictoria  = 'en:North West Victoria|zh:维多利亚州西北部|ru:Северо-западный Виктория|de:Nordwest-Victoria|fr:Partie nord-ouest de Victoria|es:Parte noroeste de Victoria|it:Parte nord-occidentale de Victoria';
		$westernVictoria    = 'en:Western Victoria|zh:维多利亚州西部|ru:Западный Виктория|de:West-Victoria|fr:Partie nord-ouest de Victoria|es:Parte noroeste de Victoria|it:Parte nord-occidentale de Victoria';
		$southCoast         = 'en:South Coast|ru:Южное побережье|zh:南海岸|es:Costa meridionale|it:Costa sur|de:Südküste|fr:Côte sud';
		$peninsulas         = 'en:The Peninsulas|es:Las penínsulas|it:Le peninsule|fr:Les péninsules|ru:Полуостровов|de:Die Halbinseln|zh:半岛';

		$regions[$sa]                                                              = [];
		$regions[$sa][$barossa][$barossaValley]                                    = [];
		$regions[$sa][$barossa]['Eden Valley']['High Eden']                        = [];
		$regions[$sa]['Far North']['Southern Flinders Ranges']                     = [];
		$regions[$sa]['Fleurieu']['Currency Creek']                                = [];
		$regions[$sa]['Fleurieu']['Kangaroo Island']                               = [];
		$regions[$sa]['Fleurieu']['Langhorne Creek']                               = [];
		$regions[$sa]['Fleurieu']['McLaren Vale']                                  = [];
		$regions[$sa]['Fleurieu']['Southern Fleurieu']                             = [];
		$regions[$sa]['Limestone Coast']['Coonawarra']                             = [];
		$regions[$sa]['Limestone Coast']['Mount Benson']                           = [];
		$regions[$sa]['Limestone Coast']['Mount Gambier']                          = [];
		$regions[$sa]['Limestone Coast']['Padthaway']                              = [];
		$regions[$sa]['Limestone Coast']['Robe']                                   = [];
		$regions[$sa]['Limestone Coast']['Wrattonbully']                           = [];
		$regions[$sa]['Lower Murray']['Riverland']                                 = [];
		$regions[$sa]['Mount Lofty Ranges']['Adelaide Hills']['Lenswood']          = [];
		$regions[$sa]['Mount Lofty Ranges']['Adelaide Hills']['Piccadilly Valley'] = [];
		$regions[$sa]['Mount Lofty Ranges']['Adelaide Plains']                     = [];
		$regions[$sa]['Mount Lofty Ranges']['Clare Valley']                        = [];
		$regions[$sa][$peninsulas]                                                 = [];
		$regions[$sa][$adelaide]                                                   = [];
		$regions[$sa][$adelaide]['Mount Lofty Ranges']                             = '_SHORTCUT';
		$regions[$sa][$adelaide]['Fleurieu']                                       = '_SHORTCUT';
		$regions[$sa][$adelaide][$barossa]                                         = '_SHORTCUT';
		$regions[$nsw]                                                             = [];
		$regions[$nsw]['Big Rivers']['Murray Darling']                             = [];
		$regions[$nsw]['Big Rivers']['Perricoota']                                 = [];
		$regions[$nsw]['Big Rivers']['Riverina']                                   = [];
		$regions[$nsw]['Big Rivers']['Swan Hill']                                  = [];
		$regions[$nsw]['Central Ranges']['Cowra']                                  = [];
		$regions[$nsw]['Central Ranges']['Mudgee']                                 = [];
		$regions[$nsw]['Central Ranges']['Orange']                                 = [];
		$regions[$nsw][$hunterValley]['Hunter']['Broke Fordwich']                  = [];
		$regions[$nsw][$hunterValley]['Hunter']['Pokolbin']                        = [];
		$regions[$nsw][$hunterValley]['Hunter']['Upper Hunter Valley']             = [];
		$regions[$nsw]['Northern Rivers']['Hastings River']                        = [];
		$regions[$nsw]['Northern Slopes']['New England Australia']                 = [];
		$regions[$nsw][$southCoast]['Shoalhaven Coast']                            = [];
		$regions[$nsw][$southCoast]['Southern Highlands']                          = [];
		$regions[$nsw][$southernNsw]['Canberra District']                          = [];
		$regions[$nsw][$southernNsw]['Gundagai']                                   = [];
		$regions[$nsw][$southernNsw]['Hilltops']                                   = [];
		$regions[$nsw][$southernNsw]['Tumbarumba']                                 = [];
		$regions[$wa]                                                              = [];
		$regions[$wa]['Central Western Australia']                                 = [];
		$regions[$wa]['Eastern Plains - Inland and North of Western Australia']    = [];
		$regions[$wa]['Greater Perth']['Peel']                                     = [];
		$regions[$wa]['Greater Perth']['Perth Hills']                              = [];
		$regions[$wa]['Greater Perth']['Swan District']['Swan Valley']             = [];
		$regions[$wa][$southWestAustralia]['Blackwood Valley']                     = [];
		$regions[$wa][$southWestAustralia]['Geographe']                            = [];
		$regions[$wa][$southWestAustralia]['Great Southern']['Albany']             = [];
		$regions[$wa][$southWestAustralia]['Great Southern']['Denmark']            = [];
		$regions[$wa][$southWestAustralia]['Great Southern']['Frankland River']    = [];
		$regions[$wa][$southWestAustralia]['Great Southern']['Mount Barker']       = [];
		$regions[$wa][$southWestAustralia]['Great Southern']['Porongurup']         = [];
		$regions[$wa][$southWestAustralia]['Manjimup']                             = [];
		$regions[$wa][$southWestAustralia]['Margaret River']                       = [];
		$regions[$wa][$southWestAustralia]['Pemberton']                            = [];
		$regions[$wa]['West Australian South East Coastal']                        = [];
		$regions[$qld]                                                             = [];
		$regions[$qld]['Granite Belt']                                             = [];
		$regions[$qld]['South Burnett']                                            = [];
		$regions[$vic]                                                             = [];
		$regions[$vic][$centralVictoria]['Bendigo']                                = [];
		$regions[$vic][$centralVictoria]['Goulburn Valley']['Nagambie Lakes']      = [];
		$regions[$vic][$centralVictoria]['Heathcote']                              = [];
		$regions[$vic][$centralVictoria]['Strathbogie Ranges']                     = [];
		$regions[$vic][$centralVictoria]['Upper Goulburn']                         = [];
		$regions[$vic]['Gippsland']                                                = [];
		$regions[$vic][$northEastVictoria]['Alpine Valleys']                       = [];
		$regions[$vic][$northEastVictoria]['Beechworth']                           = [];
		$regions[$vic][$northEastVictoria]['Glenrowan']                            = [];
		$regions[$vic][$northEastVictoria]['King Valley']                          = [];
		$regions[$vic][$northEastVictoria]['Rutherglen']                           = [];
		$regions[$vic][$northWestVictoria]['Murray Darling']                       = '_SHORTCUT';
		$regions[$vic][$northWestVictoria]['Swan Hill']                            = '_SHORTCUT';
		$regions[$vic]['Port Phillip']['Geelong']                                  = [];
		$regions[$vic]['Port Phillip']['Macedon Ranges']                           = [];
		$regions[$vic]['Port Phillip']['Mornington Peninsula']                     = [];
		$regions[$vic]['Port Phillip']['Sunbury']                                  = [];
		$regions[$vic]['Port Phillip']['Yarra Valley']                             = [];
		$regions[$vic][$westernVictoria]['Grampians']['Great Western']             = [];
		$regions[$vic][$westernVictoria]['Henty']                                  = [];
		$regions[$vic][$westernVictoria]['Pyrenees']                               = [];
		$regions[$tas]                                                             = [];
		$regions[$nt]                                                              = [];
		$regions[$act]                                                             = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

		$regions = [];
		$depths  = [5, 2];

		$regions['South Eastern Australia']       = [];
		$regions['South Eastern Australia'][$nsw] = '_SHORTCUT';
		$regions['South Eastern Australia'][$sa]  = '_SHORTCUT';
		$regions['South Eastern Australia'][$qld] = '_SHORTCUT';
		$regions['South Eastern Australia'][$vic] = '_SHORTCUT';

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}
		
		$existing = Region::whereTranslationIn('name', ['Australian Capital Territory', 'Northern Territory'], 'en')->update(['region_type_id' => 4]);

    }

}
