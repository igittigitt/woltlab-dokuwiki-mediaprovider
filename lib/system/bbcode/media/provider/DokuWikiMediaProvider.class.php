<?php

namespace wcf\system\bbcode\media\provider;

#use Guzzle\Client as Client;

/**
 * Media provider callback for DokuWiki urls.
 *
 * @author      Go4IT
 * @copyright   2023
 * @license     GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package     WoltLabSuite\Core\System\Bbcode\Media\Provider
 * @since       3.1
 */
class DokuWikiMediaProvider implements IBBCodeMediaProvider
{
    const DOKUWIKI_API_PATH = '/lib/exe/ajax.php?call=api&fn=metadata&id=';

    public function parse($url, array $matches = [])
    {
        $pageId = str_replace('/', ':', $matches['ID']);

        $apiUrl = $matches['HOST'] . self::DOKUWIKI_API_PATH . $pageId;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $metadata = curl_exec($ch);
            curl_close($ch);
            if ($metadata) {
                $metadata = json_decode($metadata, true);
                $title = $metadata['title'];
                return '<a href="' . $url . '" target="_blank" class="externalURL" rel="nofollow noopener">' . 'MK4-Wiki "' . $title . '"' . '</a>';
            }
        } catch (Exception $e) {
            # TODO: handle except
        }
        return '<a href="' . $url . '" target="_blank" class="externalURL" rel="nofollow noopener">' . 'MK4-Wiki "' . $matches['ID'] . '"' . '</a>';
    }
}
