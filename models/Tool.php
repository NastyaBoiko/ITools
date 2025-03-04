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
 * @property int $category_id
 * @property int $amount
 * @property int $min_amount Для уведомлений, что нужно докупить
 * @property string $serial_number
 * @property int $location_id
 * @property string|null $cell
 * @property int|null $project_id
 * @property string|null $inventory_time
 * @property int $delete_status 0 - не удален, 1 - удален
 * @property string|null $qr
 *
 * @property Category $category
 * @property Location $location
 * @property Order[] $orders
 * @property Project $project
 * @property ToolComment[] $toolComments
 * @property ToolHistory[] $toolHistories
 * @property ToolImage[] $toolImages
 */
class Tool extends \yii\db\ActiveRecord
{

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
            [['title', 'category_id', 'amount', 'serial_number', 'location_id'], 'required'],
            [['category_id', 'amount', 'min_amount', 'location_id', 'project_id', 'delete_status'], 'integer'],
            [['title', 'serial_number', 'cell', 'qr'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],

            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
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
            'title' => 'Название',
            'category_id' => 'Категория',
            'amount' => 'Количество',
            'min_amount' => 'Минимально необходимое количество',
            'serial_number' => 'Серийный номер',
            'location_id' => 'Месторасположение',
            'cell' => 'Полка или ячейка',
            'project_id' => 'Проект',
            'inventory_time' => 'Дата и время инвентаризации',
            'delete_status' => 'Delete Status',
            'qr' => 'Qr-код',
            'imageFiles' => 'Изображения',
        ];
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
