<?php

namespace Kitbs\Collator;

class Collator
{

	public static function getString($string, $locale = 'en')
	{
		$locale = static::simplifyLocale($locale);

		if (static::hasArticles($locale)) {
			$string = static::stripArticles($string, $locale);
		}
		
		return static::mb_ucfirst($string);

	}

	public static function getCollationKey($string, $locale)
	{
		$locale = static::simplifyLocale($locale);

		return collator_get_sort_key(static::getCollator($locale), static::getString($string, $locale));
	}

	private static function simplifyLocale($locale)
	{
		$locale = str_replace('_', '-', $locale);
		$locale = explode('-', $locale);

		return array_shift($locale);
	}

	private static function getCollator($locale)
	{
		return collator_create($locale);
	}

	private static function hasArticles($locale)
	{
		return array_key_exists($locale, static::$articles);
	}

	private static function hasJoinedArticles($locale)
	{
		return in_array($locale, static::$joinedArticles);
	}

	private static function getArticles($locale)
	{
		return static::$articles[$locale];
	}

	private static function stripArticles($string, $locale)
	{
		$break = static::getBreak($locale);

		$articles = static::getArticles($locale);
		$articles = array_map(function($article) {
			return str_replace('\'', '[\'’]', $article);
		}, $articles);

		$articles = implode('|', $articles);

		return ltrim(preg_replace('/^('.$articles.')'.$break.'/ui', '', $string));
	}

	private static function getBreak($locale)
	{
		return static::hasJoinedArticles($locale) ? '' : '(\s+|\b)';
	}

	private static function mb_ucfirst($string)
    {
        return mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
    }

	protected static $articles = [
	"sq" => ["një","disa"],
	"ar" => ["ال", "al-", "el-"],
	"ku" => ["hendê","birrê"],
	"el" => ["ο","η","το","οι","οι","τα","ένας","μια","ένα"],
	"en" => ["the","a","an","some"],
	"de" => ["der","die","das","des","dem","den","ein","eine","einer","eines","einem","einen"],
	"nl" => ["de","het","'t","een","'n"],
	"es" => ["el","la","lo","los","las","un","una","unos","unas","algo","algún","algunos","alguna","algunas","alguien"],
	"pt" => ["o","a","os","as","um","uma","uns","umas","algo","algum","alguns","alguma","algumas","alguém"],
	"fr" => ["le","la","l'","les","un","une","des","du","dela","del'","des"],
	"it" => ["il","lo","la","l'","i","gli","le","un'","uno","una","un","del","dello","della","dell'","dei","degli","degl'","delle"],
	"ro" => ["un","o","una","un"],
	"hu" => ["a","az","egy"],
	"ca" => ["el","l'","la","els","les","en","n'","na","n'","es","s'","sa","s'","es","ets","ses","un","una","uns","une"]
	];

	protected static $joinedArticles = ['ar'];

}
