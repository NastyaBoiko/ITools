<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tool".
 *
 * @property int $id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $title
 * @property int $tool_maker_id
 * @property int $category_id
 * @property int $amount
 * @property int $min_amount Для уведомлений, что нужно докупить
 * @property string $serial_number
 * @property float $diameter
 * @property float $full_length
 * @property float $work_length
 * @property int $material_made_of_id
 * @property int|null $min_amount Для уведомлений, что нужно докупить
 * @property int $location_id
 * @property string|null $cell
 * @property int|null $project_id
     
 *
 * @property Category $category
 * @property Location $location
 * @property MaterialMadeOf $materialMadeOf 
 * @property Order[] $orders
 * @property Project $project
 * @property ToolComment[] $toolComments
 * @property ToolHistory[] $toolHistories
 * @property ToolImage[] $toolImages
 * @property ToolMaker $toolMaker 
 * @property ToolMaterialUseFor[] $toolMaterialUseFors 
 */
class Tool extends \yii\db\ActiveRecord
{
    public $materialsUseFor = [];
    public $imageFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tool';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'inventory_time'], 'safe'],
            [['category_id', 'location_id'], 'required'],
            [['category_id', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['cell', 'qr'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
 
            [['tool_maker_id', 'category_id', 'diameter', 'full_length', 'work_length', 'material_made_of_id', 'location_id'], 'required'],
            [['tool_maker_id', 'category_id', 'material_made_of_id', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['diameter', 'full_length', 'work_length'], 'number'],
            [['cell', 'qr'], 'string', 'max' => 255],
            [['materialsUseFor'], 'required'],

            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
            [['material_made_of_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaterialMadeOf::class, 'targetAttribute' => ['material_made_of_id' => 'id']], 
            [['tool_maker_id'], 'exist', 'skipOnError' => true, 'targetClass' => ToolMaker::class, 'targetAttribute' => ['tool_maker_id' => 'id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер',
            'created_at' => 'Дата и время создания',
            'updated_at' => 'Дата последнего изменения',
            'tool_maker_id' => 'Производитель',
            'category_id' => 'Категория',
            'diameter' => 'Диаметр',
            'full_length' => 'Общая длина',
            'work_length' => 'Рабочая длина',
            'material_made_of_id' => 'Материал из чего',
            'materialsUseFor' => 'Материал для чего',
            'min_amount' => 'Минимально необходимое количество',
            'location_id' => 'Месторасположение',
            'cell' => 'Полка или ячейка',
            'project_id' => 'Проект',
            'inventory_time' => 'Дата и время инвентаризации',
            'delete_status' => 'Delete Status',
            'qr' => 'Qr-код',
            'imageFiles' => 'Изображения',
        ];
    }

    public function getMaterialsUseFors()
    {
        return $this->hasMany(MaterialUseFor::class, ['id' => 'material_use_for_id'])
            ->viaTable('tool_material_use_for', ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /** 
    * Gets query for [[MaterialMadeOf]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getMaterialMadeOf() 
    { 
        return $this->hasOne(MaterialMadeOf::class, ['id' => 'material_made_of_id']); 
    }

    /**
    * Gets query for [[ToolMaker]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getToolMaker()
    {
        return $this->hasOne(ToolMaker::class, ['id' => 'tool_maker_id']);
	}

    public function getToolMaterialUseFors()
	{
        return $this->hasMany(ToolMaterialUseFor::class, ['tool_id' => 'id']);
	}

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Gets query for [[ToolComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolComments()
    {
        return $this->hasMany(ToolComment::class, ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[ToolHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolHistories()
    {
        return $this->hasMany(ToolHistory::class, ['tool_id' => 'id']);
    }

    /**
     * Gets query for [[ToolImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToolImages()
    {
        return $this->hasMany(ToolImage::class, ['tool_id' => 'id']);
    }

    public function addToolMaterialUseFors($materialsToAdd)
    {
        foreach ($materialsToAdd as $key => $materialUseForId) {
            $toolMaterialUseFor = new ToolMaterialUseFor();
            $toolMaterialUseFor->tool_id = $this->id;
            $toolMaterialUseFor->material_use_for_id = $materialUseForId;
            if (!$toolMaterialUseFor->save()) {
                return false;
            }
        }
        return true;
    }

    public function updateToolMaterialUseFors(array $materialsUseForCurrent)
    {
        // Добавлены
        $materialsToAdd = array_diff($this->materialsUseFor, $materialsUseForCurrent);

        if (!empty($materialsToAdd)) {
            if (!$this->addToolMaterialUseFors($materialsToAdd)) {
                return false;
            }
        }

        // Удалены
        $materialsToDelete = array_diff($materialsUseForCurrent, $this->materialsUseFor);

        if (!empty($materialsToDelete)) {
            ToolMaterialUseFor::deleteAll([
                'tool_id' => $this->id,
                'material_use_for_id' => $materialsToDelete,
            ]);
        }

        return true;
    }

    public function upload(): array|bool
    {
        $uploadFiles = [];
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $fileName = 
                            Yii::$app->user->id . '_' 
                            .  Yii::$app->security->generateRandomString(7)
                            . '.' . $file->extension;

                $file->saveAs('uploads/' . $fileName);
                array_push($uploadFiles, $fileName);
            }
            return $uploadFiles;
        } else {
            return false;
        }
    }

    public function saveToolData() 
    {
        if ($imgUrls = $this->upload()) {
            if ($this->save(false)) {
                foreach($imgUrls as $imgUrl) {
                    $toolImage = new ToolImage();
                    $toolImage->tool_id = $this->id;
                    $toolImage->image = $imgUrl;
                    if (!$toolImage->save()) {
                        return false;
                    }
                }
                return true;
            } 
        } else {
            if ($this->save()) {
                return true;
            }
        }
    }
}
