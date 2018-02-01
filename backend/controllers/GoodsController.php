<?php

namespace backend\controllers;

use Yii;
use backend\models\Goods;
use backend\models\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use moonland\phpexcel\Excel;
use PHPExcel;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * yii2-phpexcel  实现excel导出功能
     * php excel导出
     */
    public function actionExport()
    {

        $result = Goods::find()->asArray()->all();
        if (!$result) {
            echo "数据不存在";
        }

        Excel::export([
            'models' => $result,
            'format' => 'Excel2007',
            'fileName' => date('Ymd') . '_' . 'Export',
            'columns' => ['id', 'name', 'created_at:datetime', 'updated_at:datetime'],
            'headers' => [
                'id' => 'id',
                'name' => 'name',
                'created_at' => 'created_at',
                'updated_at' => 'updated_at',
            ],
        ]);
    }

    /**
     * yii2-phpexcel  实现excel导入功能
     * import 读取excel表格的内容
     */
    public function actionImport3()
    {
        $file = isset($_FILES['myfile']['tmp_name'])?$_FILES['myfile']['tmp_name']:Yii::getAlias("@webroot") . "/data1.xls";
        $data = Excel::import($file, [
            'setFirstRecordAsKeys' => true,
            'setIndexSheetByName' => true,
            'getOnlySheet' => 'sheet1',
        ]);
        foreach ($data as $item) {
            $imageModel = new Goods();
            $imageModel->name = $item['name'];
            $result = $imageModel->save();
            if(!$result){
                var_dump($imageModel->errors);
            }else{
                echo 1;
            }
        }
        die;
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * 读取excel的内容组成数组
     */
    public function actionRead()
    {
        $file = Yii::getAlias("@webroot") . "/data1.xls";
        $objReader = new \PHPExcel_Reader_Excel5();
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->getSheet(0);
        $highestRow = $objWorksheet->getHighestRow();//最大行数，为数字
        $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字
        $tableData = [];
        for ($row = 2; $row <= $highestRow; $row++) {
            for ($col = 1; $col < $highestColumnIndex; $col++) {
                $tableData[$row][$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        var_dump($tableData);
        die;
    }

    /**
     * 导入excel的内容，读取excel，循环插入mysql表中
     */
    public function actionImport()
    {
        //参考网址  http://www.jb51.net/article/95671.htm

        /**
         * 2015年10月12日 下午6:01:26 这种格式时间戳转化
         */
//        $arr = date_parse_from_format("Y年m月d日 下午h:i:s", "2015年10月12日 下午6:01:26");
//        $timestamp = mktime($arr['hour'], $arr['minute'], $arr['second'], $arr['month'], $arr['day'], $arr['year']);
//        echo $timestamp;
//        die;

        $file = Yii::getAlias("@webroot") . "/data1.xls";
        $objReader = new \PHPExcel_Reader_Excel5();

        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->getSheet(0);
        $highestRow = $objWorksheet->getHighestRow();//最大行数，为数字
        $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字

        $tableData = [];
        for ($row = 2; $row <= $highestRow; $row++) {
//            $b = $objPHPExcel->getActiveSheet()->getCell("A" . $row)->getValue();
            //获取B列的值
            $name = $objPHPExcel->getActiveSheet()->getCell("B" . $row)->getValue();//获取B列的值
//            $tableData[]=$name;
            $created_at = $objPHPExcel->getActiveSheet()->getCell("C" . $row)->getValue();//获取C列的值
            $updated_at = $objPHPExcel->getActiveSheet()->getCell("D" . $row)->getValue();//获取D列的值
            $arr = date_parse_from_format("Y年m月d日 下午h:i:s", $created_at);
            $created_at = mktime($arr['hour'], $arr['minute'], $arr['second'], $arr['month'], $arr['day'], $arr['year']);
            $m = new Goods();
            $m->name = $name;
            $m->created_at = $created_at;
            $m->updated_at = $created_at;
            $num = $m->save();
            if ($num) {
                echo 1;
            } else {
                var_dump($m->errors);
            }
//            for($col=1;$col< $highestColumnIndex;$col++){
//                $tableData[$row][$col] = $objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
//            }
        }
//        die;
        var_dump($name);
        die;
    }

    public function actionImport1()
    {
        // 实例化exel对象
//文件路径
        $file_path = Yii::getAlias("@webroot") . "/data1.xls";
        if (!file_exists($file_path)) {
            die('file not exists');
        }
//文件的扩展名
        $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        if ($ext == 'xlsx') {
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($file_path);
        } elseif ($ext == 'xls') {
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_path);
        }
        $objReader->setReadDataOnly(true);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();//获取总行数
        $highestColumn = $sheet->getHighestColumn();//获取总列数


//10  B
        for ($i = 2; $i <= $highestRow; $i++) {
            $record = array();//申明每条记录数组
//            for ($j = 'A';$j<=$highestColumn;$j++){
//                $record[] = $objPHPExcel->getActiveSheet()->getCell("$j$i")->getValue();//读取单元格
//            }
            $name = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();//获取B列的值
            $m = new Goods();
            $m->name = $name;
            $num = $m->save();
            if ($num) {
                echo 1;
            } else {
                var_dump($m->errors);
            }

        }
        die;

    }

    public function actionDaoru()
    {
        return $this->render('daoru');
    }

    public $enableCsrfValidation = false;

    /*     * 表数据转化为数组 excel 低版本excel，不包括excel2007     */
    public function actionImport2()
    {
        // 参考上传的链接地址 https://www.cnblogs.com/zxf100/archive/2017/06/07/6957532.html
        //判断是否选择了要上传的表格
        if (empty($_FILES['myfile'])) {
            echo "<script>alert('您未选择表格');history.go(-1);</script>";
        }

        //获取表格的大小，限制上传表格的大小5M
        $file_size = $_FILES['myfile']['size'];
        if ($file_size > 5 * 1024 * 1024) {
            echo "<script>alert('上传失败，上传的表格不能超过5M的大小');history.go(-1);</script>";
            exit();
        }

        //限制上传表格类型
        $file_type = $_FILES['myfile']['type'];
        //application/vnd.ms-excel  为xls文件类型
        if ($file_type != 'application/vnd.ms-excel') {
            echo "<script>alert('上传失败，只能上传excel2003的xls格式!');history.go(-1)</script>";
            exit();
        }

//判断表格是否上传成功
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {
//            var_dump($_FILES);die;

//            require_once 'PHPExcel.php';
//            require_once 'PHPExcel/IOFactory.php';
//            require_once 'PHPExcel/Reader/Excel5.php';
            //以上三步加载phpExcel的类
            var_dump($_FILES);
            $ext = strtolower(pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION));
            var_dump($ext);
            die;
            if ($ext == 'xlsx') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            } elseif ($ext == 'xls') {
                $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            }
//            $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
            //接收存在缓存中的excel表格
            $filename = $_FILES['myfile']['tmp_name'];
            $objPHPExcel = $objReader->load($filename); //$filename可以是上传的表格，或者是指定的表格
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            // $highestColumn = $sheet->getHighestColumn(); // 取得总列数

            //循环读取excel表格,读取一条,插入一条
            //j表示从哪一行开始读取  从第二行开始读取，因为第一行是标题不保存
            //$a表示列号
            for ($j = 2; $j <= $highestRow; $j++) {
                $name = $objPHPExcel->getActiveSheet()->getCell("B" . $j)->getValue();//获取B(密码)列的值
                $m = new Goods();
                $m->name = $name;
                $num = $m->save();
                if ($num) {
                    echo "<script>alert('添加成功！');</script>";
                } else {
                    echo "<script>alert('" . $m->errors . "');</script>";
                }

            }
            die;
        }
    }
}
