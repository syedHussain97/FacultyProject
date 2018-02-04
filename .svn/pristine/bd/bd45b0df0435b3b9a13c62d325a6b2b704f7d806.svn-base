<?php

class Product_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function getAllProductCategories() {
		$q = $this->db->get(APP_TABLE_PRODUCT_CATEGORY);
		return $q->result_array();
	}
	
	function getAllProductSeries() {
		$q = $this->db->get(APP_TABLE_PRODUCT_SERIES);
		return $q->result_array();
	}
	
	function getAllProducts() {
		$q = $this->db->get(APP_TABLE_PRODUCTS);
		return $q->result_array();
	}
	
	function productCategoryExist($catId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_CATEGORY, array("product_category_id" => $catId));
		return ($q->num_rows() > 0);
	}
	
	function updateProductCategory($title, $description,$catId) {
		$this->db->where('product_category_id', $catId);
		$this->db->update(APP_TABLE_PRODUCT_CATEGORY, array("product_category_name" => $title, "product_category_description" => $description));
		return $this->db->insert_id();
	}
	
	function deleteProductCategory($catId) {
		$this->db->delete(APP_TABLE_PRODUCT_CATEGORY, array("product_category_id" => $catId));
	}
	
	function productCategoryTitleExistsExcept($title, $languageId, $catId) {
		$q = $this->db->select('*')->from(APP_TABLE_PRODUCT_CATEGORY . ' c')->join(APP_TABLE_LANGUAGE_TEXT . ' lt', 'lt.language_text_identifier = c.product_category_name')->where(array('lt.language_text_content' => $title, 'lt.language_text_language_id' => $languageId, 'product_category_id !=' => $catId))->get();
		return ($q->num_rows() > 0);
	}
	
	function productCategoryTitleExists($title, $languageId) {
		$q = $this->db->select('*')->from(APP_TABLE_PRODUCT_CATEGORY . ' c')->join(APP_TABLE_LANGUAGE_TEXT . ' lt', 'lt.language_text_identifier = c.product_category_name')->where(array('lt.language_text_content' => $title, 'lt.language_text_language_id' => $languageId))->get();
		return ($q->num_rows() > 0);
	}
	
	function productSeriesTitleExistsExcept($title, $languageId, $serId) {
		$q = $this->db->select('*')->from(APP_TABLE_PRODUCT_SERIES . ' s')->join(APP_TABLE_LANGUAGE_TEXT . ' lt', 'lt.language_text_identifier = s.product_series_name')->where(array('lt.language_text_content' => $title, 'lt.language_text_language_id' => $languageId, 'product_series_id !=' => $serId))->get();
		return ($q->num_rows() > 0);
	}

	function productSeriesTitleExists($title, $languageId) {
		$q = $this->db->select('*')->from(APP_TABLE_PRODUCT_SERIES . ' s')->join(APP_TABLE_LANGUAGE_TEXT . ' lt', 'lt.language_text_identifier = s.product_series_name')->where(array('lt.language_text_content' => $title, 'lt.language_text_language_id' => $languageId))->get();
		return ($q->num_rows() > 0);
	}
	
	function createProductCategory($title, $description) {
		$this->db->insert(APP_TABLE_PRODUCT_CATEGORY, array("product_category_name" => $title, "product_category_description" => $description));
		return $this->db->insert_id();
	}
	
	function createProductSeries($title, $description, $features, $catId) {
		$this->db->insert(APP_TABLE_PRODUCT_SERIES, array("product_series_name" => $title, "product_series_description" => $description, "product_series_features" => $features, "product_series_category" => $catId));
		return $this->db->insert_id();
	}

	function createProductSeriesSpecs($title, $seriesId) {
		$this->db->insert(APP_TABLE_PRODUCT_SERIES_SPECS, array("product_series_id" => $seriesId, "product_series_spec_title" => $title));
		return $this->db->insert_id();
	}
	
	function productSeriesSpecExists($specId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SERIES_SPECS, array("product_series_spec_id" => $specId));
		return ($q->num_rows > 0);
	}
	
	function productSeriesExists($seriesId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SERIES, array("product_series_id" => $seriesId));
		return ($q->num_rows() > 0);
	}
	
	function getProductInfo($productId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCTS, array("product_id" => $productId));
		return $q->row_array();
	}
	
	function getProductSeriesInfo($productSeriesId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SERIES, array("product_series_id" => $productSeriesId));
		return $q->row_array();
	}
	
	function getProductsForSeries($seriesId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCTS, array("product_series" => $seriesId));
		return $q->result_array();
	}
	
	function updateProductSeries($title, $description, $features, $catId, $serId) {
		$this->db->where("product_series_id", $serId);
		$this->db->update(APP_TABLE_PRODUCT_SERIES, array("product_series_name" => $title, "product_series_description" => $description, "product_series_features" => $features, "product_series_category" => $catId));
		return $this->db->insert_id();
	}
	
	function deleteProductSeries($seriesId) {
		$this->db->delete(APP_TABLE_PRODUCT_SERIES,array("product_series_id" => $seriesId));
	}
	
	function getProductSeriesSpecs($productSeriesId) {
		$q = $this->db->select('*')->from(APP_TABLE_PRODUCT_SERIES_SPECS)->where(array("product_series_id" => $productSeriesId))->order_by('product_series_spec_order','asc')->get();
		return $q->result_array();
	}
	
	function getProductSeriesSpecById($specId ,$id) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SERIES_SPECS,array( "product_series_spec_id" => $specId));
		return $q->row_array();
	}
	
	function deleteProductSeriesSpecById($specId, $id) {
		$this->db->delete(APP_TABLE_PRODUCT_SERIES_SPECS,array( "product_series_spec_id" => $specId));
	}
	
	function deleteSeriesSpecs($specs = array()) {
		foreach ($specs as $spec) {
			$this->db->delete(APP_TABLE_PRODUCT_SERIES_SPECS, array("product_series_spec_id" => $spec));
		}
	}
	
	function deleteBulkSeries($seriess = array()) {
		foreach ($seriess as $series) {
			$this->db->delete(APP_TABLE_PRODUCT_SERIES, array("product_series_id" => $series));
		}
	}
	
	function deleteBulkCategories($categories = array()) {
		foreach ($categories as $category) {
			$this->db->delete(APP_TABLE_PRODUCT_CATEGORY, array("product_category_id" => $category));
		}
	}
	
	function getProductCategoryInfo($productCategoryId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_CATEGORY, array("product_category_id" => $productCategoryId));
		return $q->row_array();
	}
	
	function getSeriesForCategory($catId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SERIES, array("product_series_category" => $catId));
		return $q->result_array();
	}
	
	function addProduct($model, $series, $desc) {
		$this->db->insert(APP_TABLE_PRODUCTS, array("product_series" => $series, "product_model" => $model, "product_description" => $desc));
		return $this->db->insert_id();
	}
	
	function editProduct($pId, $model, $series, $desc) {
		$this->db->where("product_id", $pId);
		$this->db->update(APP_TABLE_PRODUCTS, array("product_series" => $series, "product_model" => $model, "product_description" => $desc));
		return $this->db->insert_id();
	}
	
	function deleteProduct($pId, $seriesId) {
		$this->db->delete(APP_TABLE_PRODUCTS, array("product_series" => $seriesId, "product_id" => $pId));
	}
	
	function deleteBulkProducts($products = array()) {
		foreach ($products as $product) {
			$this->db->delete(APP_TABLE_PRODUCTS, array("product_id" => $product));
		}
	}
	
	function getProductForSeriesById($seriesId, $pId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCTS, array("product_series" => $seriesId, "product_id" => $pId));
		return $q->row_array();
	}
	
	function countProducts($seriesId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCTS, array("product_series" => $seriesId));
		return $q->num_rows();
	}
	
	function productExists($productId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCTS, array("product_id" => $productId));
		return ($q->num_rows() > 0);
	}
	
	
	function setProductSpecValue($productId, $specId, $value) {
		$spec = $this->getProductSpec($productId, $specId);
		if (!$spec) {
			$this->db->insert(APP_TABLE_PRODUCT_SPECS, array("product_spec_product_id" => $productId, "product_series_spec_id" => $specId, "product_spec_value" => $value));
			return $this->db->insert_id();
		} else {
			$this->db->update(APP_TABLE_PRODUCT_SPECS, array("product_spec_value" => $value), array("product_spec_id" => $spec["product_spec_id"]));
			return $spec["product_spec_id"];
		}
	}
	
	function getProductSpec($productId, $seriesSpecId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SPECS, array("product_spec_product_id" => $productId, "product_series_spec_id" => $seriesSpecId));
		if ($q->num_rows() > 0) {
			return $q->row_array();
		} else {
			return false;
		}
	}
	
	function getProductSpecValue($productId, $seriesSpecId) {
		$q = $this->db->get_where(APP_TABLE_PRODUCT_SPECS, array("product_spec_product_id" => $productId, "product_series_spec_id" => $seriesSpecId));
		if ($q->num_rows() > 0) {
			$res = $q->row_array();
			return $res["product_spec_value"];
		} else {
			return false;
		}
	}
	
	function orderSeriesSpecs($specId, $specOrder) {
		$this->db->update(APP_TABLE_PRODUCT_SERIES_SPECS, array("product_series_spec_order" => $specOrder), array("product_series_spec_id" => $specId));
	}
}

?>