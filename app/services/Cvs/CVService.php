<?php

namespace App\services\Cvs;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\MagicConst\Dir;

class CVService
{
    private const MAIN_PATH = "app" . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "cvs" . DIRECTORY_SEPARATOR;
    private Request $request;
    public  function getFileData(Request $request): array
    {
        $this->request = $request;
        $fileData = [];
        if ($request->hasFile('cv')) {
            $fileData['file_name'] = $request->file('cv')->getClientOriginalName();
            $fileData['file_type'] = $request->file('cv')->getClientOriginalExtension();
            $fileData['file_size'] = $request->file('cv')->getSize();
            $fileData['file_path'] = self::MAIN_PATH;
            $fileData['name'] = $request->safe()->name;
            $fileData['status'] = (string)$request->safe()->status;
            $fileData['company_name'] = $request->safe()->company_name ?? "";
            return $fileData;
        }
        return [];
    }

    public function uploadCv(int $id): bool
    {
        if (!file_exists(storage_path(self::MAIN_PATH . $id))) {
            $dirname = mkdir(storage_path(self::MAIN_PATH . $id));
            if ($dirname) {
                $filepath = storage_path(self::MAIN_PATH . $id . DIRECTORY_SEPARATOR) . $this->request->file('cv')->getClientOriginalName();

                if (move_uploaded_file($this->request->file('cv')->getLinkTarget(), $filepath)) {
                    return true;
                };
            }
        }
        return false;
    }

    public static function removeCv(Cv $cv)
    {
        $dir = storage_path($cv->file_path  . $cv->id);
        $fileName = $dir . DIRECTORY_SEPARATOR . $cv->file_name;
        if (file_exists($fileName)) {
            if (unlink($fileName)) {
                return rmdir($dir);
            }
        }
        return false;
    }
}
