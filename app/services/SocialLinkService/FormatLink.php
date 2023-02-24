<?php

namespace App\services\SocialLinkService;

use App\Models\SocialLink;

class FormatLink
{


    private static function get(array $status)
    {
        return SocialLink::whereIn('status', $status)->get();
    }

    public static function make(array $status = ["0", "1"]): array
    {
        $newSocialLinks = [];
        foreach (self::get($status) as $link) {
            $url  = explode('.', explode('/', $link->url)[2] ?? "");
            $name = '';
            if (count($url) == 2) {
                $name = $url[0];
            } else {
                $name = $url[1];
            }
            $newSocialLinks[] = [
                $name => $link->url,
                'status' => $link->status
            ];
        }

        return $newSocialLinks;
    }
}
