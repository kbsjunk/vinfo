<?php

use Vinfo\Region;

class RegionsNZTableSeeder extends RegionsTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$country = Region::whereTranslation('name', 'New Zealand', 'en')->first();
		DB::table('regions')->where('country_id', $country->country_id)->where('id', '!=', $country->id)->delete();
		
		$regions = [];
		$depths  = [7, 8];

		$waikato           = 'en:Waikato|zh:怀卡托';
		$bayOfPlenty       = 'en:Bay of Plenty|zh:普伦蒂湾';
		$nelson            = 'en:Nelson|zh:纳尔逊';
		$wairarapa         = 'en:Wairarapa|zh:怀拉拉帕';
		$marlborough       = 'en:Marlborough|zh:马尔堡';
		$centralOtago      = 'en:Central Otago|zh:中奥塔哥';
		$canterburyWaipara = 'en:Canterbury/ Waipara|zh:坎特伯雷/ 怀帕拉';
		$auckland          = 'en:Auckland|zh:奥克兰';
		$hawkesBay         = 'en:Hawke\'s Bay|zh:霍克湾';
		$gisborne          = 'en:Gisborne|zh:吉斯伯恩';
		$northland         = 'en:Northland|zh:北地';

		$regions[$northland]                                           = [];
		$regions[$auckland]                                            = [];
		$regions[$auckland]["en:Waiheke Island|zh:怀赫科岛"]               = [];
		$regions[$auckland]["en:Henderson|zh:亨德森"]                     = [];
		$regions[$auckland]["en:Clevedon|zh:克利文顿"]                     = [];
		$regions[$auckland]["en:Matakana|zh:马塔卡纳"]                     = [];
		$regions[$auckland]["en:Kumeu|zh:库姆"]                          = [];
		$regions[$waikato]                                             = [];
		$regions[$bayOfPlenty]                                         = [];
		$regions[$gisborne]                                            = [];
		$regions[$hawkesBay]                                           = [];
		$regions[$hawkesBay]["en:Gimblett Gravels|zh:吉布利特砾石"]        = [];
		$regions[$wairarapa]                                           = [];
		$regions[$wairarapa]["en:Carterton|zh:卡特顿"]                    = [];
		$regions[$wairarapa]["en:Masterton|zh:马斯特顿"]                   = [];
		$regions[$wairarapa]["en:South Wairarapa|zh:南怀拉拉帕"]            = [];
		$regions[$wairarapa]["en:Martinborough|zh:马丁堡"]                = [];
		$regions[$marlborough]                                         = [];
		$regions[$marlborough]["en:Southern Valleys|zh:南山谷"]           = [];
		$regions[$marlborough]["en:Wairau Valley|zh:怀劳谷"]              = [];
		$regions[$marlborough]["en:Awatere Valley"]                    = [];
		$regions[$nelson]                                              = [];
		$regions[$nelson]["en:Moutere|zh:莫铁利"]                         = [];
		$regions[$nelson]["en:Brightwater|zh:布赖特沃特"]                   = [];
		$regions[$canterburyWaipara]                                   = [];
		$regions[$canterburyWaipara]["en:Waipara Valley|zh:怀帕拉谷"]      = [];
		$regions[$canterburyWaipara]["en:Canterbury Plains|zh:坎特伯雷平原"] = [];
		$regions[$canterburyWaipara]["en:Waitaki Valley|zh:怀塔基谷"]      = [];
		$regions[$centralOtago]                                        = [];
		$regions[$centralOtago]["en:Wanaka|zh:瓦纳卡"]                    = [];
		$regions[$centralOtago]["en:Gibbston|zh:吉布斯顿"]                 = [];
		$regions[$centralOtago]["en:Bannockburn|zh:班诺克本"]              = [];
		$regions[$centralOtago]["en:Alexandra|zh:亚历山德拉"]               = [];
		$regions[$centralOtago]["en:Roxburgh|zh:罗克斯堡"]                 = [];
		$regions[$centralOtago]["en:Bendigo|zh:本迪戈"]                   = [];
		$regions[$centralOtago]["en:Lowburn/ Pisa|zh:洛本/比萨"]           = [];
		$regions[$centralOtago]["en:Cromwell|zh:克伦威尔"]                 = [];

		foreach ($regions as $region => $children) {
			$this->makeChild($country, $region, $children, $depths, $country->country_id);
		}

    }

}
