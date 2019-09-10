<?php

namespace Atf\Models;

use Illuminate\Database\Eloquent\Model;
use Atf\Models\tAtfModel;

/**
 * Modelクラスを継承したクラス
 * 他のモデルクラスは、基本的にこのクラスを継承する
 * @author y-hatsutori
 */
class AtfModel extends Model {

    use tAtfModel;
}
