# woltlab-dokuwiki-mediaprovider
Add Mediaprovider for Woltlab Forum to replace DokuWiki links with their page-title.

# requirements
- DokuWiki installed
- DokuWiki plugin "API" installed (https://www.dokuwiki.org/plugin:api)
- Pages of DokuWiki must be public accessible

# install

1.) copy the file DokuWikiMediaProvider.class.php into the given directory /lib/system/bbcode/media/provider/
in Woltlab installation root

2.) in Woltlab admin (ACP) switch to "Content" -> "Mediaprovider" an add a new provider (mame it to whatever you like).
- In the regex field this and replace __DOKUWIKI_DOMAIN__ with the root domain of your DokuWiki installation (e.g. "https://dokuwiki.org")
(?<HOST>__DOKUWIKI_DOMAIN__)/(?<ID>[/a-zA-Z0-9_-]+)
- Set wcf\system\bbcode\media\provider\DokuWikiMediaProvider into field "Classname"
- Save it

# usage

Now, whenever you paste a link to your DokuWiki into a Woltlab post,
the mediaprovider fetches the metadata of the given page and add's
the title of the page as text of the link.
