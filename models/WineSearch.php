<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wine;

/**
 * WineSearch represents the model behind the search form of `app\models\Wine`.
 */
class WineSearch extends Wine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'points', 'country_id', 'province_id', 'variety_id', 'winery_id'], 'integer'],
            [['description', 'designation'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $region_id = null, $variety_id = null)
    {
        $query = Wine::find();

        if($region_id != null){
            $subquery = WineRegion::find()
            ->select(['wine_region.wine_id'])
            ->where(['wine_region.region_id'=>$region_id]);

            $query->where(['wine.id'=>$subquery]);
        }

       if($variety_id != null){
            
            $query->where(['wine.variety_id'=>$variety_id]);
        }

        /*
            select wine.*
            from wine
            where variety.id = 5);
        */

        /*
            select wine.*
            from wine
            where wine.id in (
                select wine_region.wine_id 
                from wine_region 
                where wine_region.region_id = 5);

        */

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'points' => $this->points,
            'price' => $this->price,
            'country_id' => $this->country_id,
            'province_id' => $this->province_id,
            'variety_id' => $this->variety_id,
            'winery_id' => $this->winery_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'designation', $this->designation]);

        return $dataProvider;
    }
}
