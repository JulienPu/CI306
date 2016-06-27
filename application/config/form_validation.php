<?php 
// 配置验证规则
$config=array(
	// 文章的验证规则
	'article'=>array(
		// 对应的单个字段的验证规则
		array(
			'field'=>'title',
			'label'=>'标题',
			'rules'=>'required|min_length[5]',
			),
		array(
			'field'=>'type',
			'label'=>'类型',
			'rules'=>'required|integer',
			),
		array(
			'field'=>'cid',
			'label'=>'栏目',
			'rules'=>'integer',
			),
		array(
			'field'=>'abstract',
			'label'=>'摘要',
			'rules'=>'required|max_length[110]',
			),
		array(
			'field'=>'content',
			'label'=>'内容',
			'rules'=>'required|max_length[2000]',
			)
	),
	// 栏目验证规则
	'category'=>array(
		// 对应的单个字段的验证规则
		array(
			'field'=>'cname',
			'label'=>'栏目标题',
			'rules'=>'required|max_length[20]',
			),
	),
);