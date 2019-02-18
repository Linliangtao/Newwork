<?php
error_reporting(0);
header('Content-type:text/json');//输出JSON数据

$ac=$_GET['ac'];//操作识别符
$banner=array(
	array(
		'title' => '时髦女装',//标题
		'img' => 'https://img.alicdn.com/tps/i4/TB1Uoq9mgDqK1RjSZSySuuxEVXa.jpg_q90_.webp',//图片地址
		'url' => 'http://www.baidu.com/'//链接
	),
	array(
		'title' => '爱上名流店',//标题
		'img' => 'https://aecpm.alicdn.com/simba/img/TB183NQapLM8KJjSZFBSutJHVXa.jpg',//图片地址
		'url' => 'javascript:;'//链接
	),
	array(
		'title' => '只给你想要的',//标题
		'img' => 'https://aecpm.alicdn.com/simba/img/TB1JNHwKFXXXXafXVXXSutbFXXX.jpg',//图片地址
		'url' => 'javascript:;'//链接
	),
	array(
		'title' => '品牌盛宴',//标题
		'img' => 'https://aecpm.alicdn.com/simba/img/TB1XotJXQfb_uJkSnhJSuvdDVXa.jpg',//图片地址
		'url' => 'javascript:;'//链接
	),
	array(
		'title' => '装修建材',//标题
		'img' => 'https://img.alicdn.com/tps/i4/TB1K4q.l7zoK1RjSZFlSuui4VXa.jpg_q90_.webp',//图片地址
		'url' => 'javascript:;'//链接
	),

);//banner数据
$news=array(
	array(
		'id' => 1,//资讯ID
		'title' => '受台风“玉兔”影响，发货延迟！',//标题
		'ishot' => 1//是否是热门，0为否，1为是
	),
	array(
		'id' => 2,//资讯ID
		'title' => '酷购商城微信版上线啦！',//标题
		'ishot' => 0//是否是热门，0为否，1为是
	),
	array(
		'id' => 3,//资讯ID
		'title' => '马上就要开学了，书包买买买！',//标题
		'ishot' => 0//是否是热门，0为否，1为是
	)
);//资讯数据
$goods=array(
	array(
		'id' => 1,//商品ID
		'title' => 'Apple 苹果 iPhoneX 全新发布',//商品标题
		'stitle' => '全网通 64G 深空灰',//副标题
		'img' => 'https://m.360buyimg.com/n1/jfs/t15787/353/109633918/16701/5a8390ef/5a27ae6dNc530b5bb.jpg!q70.jpg',//商品图片地址
		'price' => '8085.00'//商品价格
	),
	array(
		'id' => 2,//商品ID
		'title' => 'Apple 苹果 iPhone6 全新发布',//商品标题
		'stitle' => '全网通 64G 土豪金',//副标题
		'img' => 'https://m.360buyimg.com/mobilecms/s240x240_jfs/t14125/285/900232321/14466/12dfc3a3/5a163dd1Ne09fad4b.jpg!q70.jpg',//商品图片地址
		'price' => '5085.00'//商品价格
	),
	array(
		'id' => 3,//商品ID
		'title' => '华硕笔记本 AS0568',//商品标题
		'stitle' => '红黑 15\' 1T 16G',//副标题
		'img' => 'https://m.360buyimg.com/mobilecms/s240x240_jfs/t15811/137/1521616135/14255/a6150285/5a546fadN096d46b4.jpg!q70.jpg',//商品图片地址
		'price' => '4085.00'//商品价格
	),
	array(
		'id' => 4,//商品ID
		'title' => '华为手环',//商品标题
		'stitle' => '黑色',//副标题
		'img' => 'https://m.360buyimg.com//mobilecms/s276x276_jfs/t5848/205/6830434960/124593/19e83624/596c8b4eN3c8ba6a7.jpg!q70.jpg',//商品图片地址
		'price' => '285.00'//商品价格
	),
	array(
		'id' => 5,//商品ID
		'title' => '索尼（SONY）黑卡 DSC-RX100M6  1英寸大底数码相机/卡片机/照相机 24-200mm大变焦蔡司镜头（RX100VI/黑卡6）',//商品标题
		'stitle' => '黑色 黑卡',//副标题
		'img' => '//img14.360buyimg.com/n7/jfs/t21142/179/866745808/171998/b00d0a26/5b19e3f5N936dfaff.jpg',//商品图片地址
		'price' => '8399.00'//商品价格
	),
	array(
		'id' => 6,//商品ID
		'title' => '荣耀MagicBook 14英寸轻薄窄边框笔记本电脑（AMD锐龙5 8G 256G FHD IPS 正版Office）冰河银',//商品标题
		'stitle' => '14英寸 轻薄窄边框',//副标题
		'img' => '//img11.360buyimg.com/n7/jfs/t1/4721/9/10248/150808/5bc9be1bE2b670a2a/7954518702f3f92d.jpg',//商品图片地址
		'price' => '3999.00'//商品价格
	),

);//商品数据

$goods_item = array(//单个商品的数据
	'imgs' => array(//图片列表
		array(
			'img' => 'https://m.360buyimg.com/n12/jfs/t12352/88/127708421/67468/90baaf73/5a04172aN29f845bf.jpg!q70.jpg',//图片地址
			'title' => '正反面'//标题
		),
		array(
			'img' => 'https://m.360buyimg.com/n12/jfs/t13438/360/124743365/49464/474ae43b/5a03ffaeNeb7db52b.jpg!q70.jpg',//图片地址
			'title' => '正面'//标题
		),
		array(
			'img' => 'https://m.360buyimg.com/n12/jfs/t12814/353/139949949/27453/5a037076/5a03ff88N7bdff90d.jpg!q70.jpg',//图片地址
			'title' => '反面'//标题
		),
		array(
			'img' => 'https://m.360buyimg.com/n12/jfs/t12814/353/139949949/27453/5a037076/5a03ff88N7bdff90d.jpg!q70.jpg',//图片地址
			'title' => '斜面'//标题
		),
		array(
			'img' => 'https://m.360buyimg.com/n12/jfs/t11140/344/1557119770/31087/d11c46ac/5a03ff9fNd553a907.jpg!q70.jpg',//图片地址
			'title' => '平面'//标题
		)
	),
	'title' => 'Apple 苹果 iPhone X 手机 全面屏 银色 64GB',//标题
	'dv' => 1085,//月销量
	'items' => array(//颜色，型号，版本等
		array(
			'name' => '银色',
			'img' => 'https://m.360buyimg.com/n1/jfs/t15787/353/109633918/16701/5a8390ef/5a27ae6dNc530b5bb.jpg!q70.jpg',//图片
			'models' => array(//版本
				array(
					'name' => '64G',//版本名称
					'price' => '6800.00',
					'gnum' => '51867'
				),
				array(
					'name' => '256G',//版本名称
					'price' => '7800.00',
					'gnum' => '51868'
				),
				array(
					'name' => '64G+一年碎屏险套餐',//版本名称
					'price' => '8099.00',
					'gnum' => '51869'
				),
				array(
					'name' => '256G+一年碎屏险套餐',//版本名称
					'img' => '',//图片
					'price' => '8299.00',
					'gnum' => '51870'
				)
			),
		),
		array(
			'name' => '黑色',
			'img' => '//img13.360buyimg.com/n5/s54x54_jfs/t10675/253/1344769770/66891/92d54ca4/59df2e7fN86c99a27.jpg',//图片
			'models' => array(//版本
				array(
					'name' => '64G',//版本名称
					'price' => '6800.00',
					'gnum' => '51871'
				),
				array(
					'name' => '256G',//版本名称
					'price' => '7800.00',
					'gnum' => '51872'
				),
				array(
					'name' => '64G+一年碎屏险套餐',//版本名称
					'price' => '8099.00',
					'gnum' => '51873'
				),
				array(
					'name' => '256G+一年碎屏险套餐',//版本名称
					'img' => '',//图片
					'price' => '8299.00',
					'gnum' => '51874'
				)
			),
		)
	),
	'params' => '<table class="table table-condensed parameter-table"><tr><th>品牌</th><td>Apple/苹果</td></tr><tr><th>Apple型号</th><td>Apple X</td></tr><tr><th>网络类型</th><td>无需合约版</td></tr><tr><th>机身颜色</th><td>深空灰色 银色</td></tr><tr><th>套餐类型</th><td>官方标配</td></tr><tr><th>售后服务</th><td>全国联保</td></tr><tr><th>存储容量</th><td>256GB 64GB</td></tr></table>',//商品参数
	'comm_num' => 6,//评论数量
	'intro' =>'<p><img src="https://img30.360buyimg.com/popWareDetail/jfs/t14719/85/1877166841/278152/3ae6ff0/5a5efcd6N154d1c5a.jpg" alt=""><img src="https://img30.360buyimg.com/popWareDetail/jfs/t13027/52/352981969/231830/badc500e/5a095d00N15968051.jpg" alt=""><img src="https://img10.360buyimg.com/imgzone/jfs/t9835/131/1905669916/3042823/cb300cef/59e9b116Nd9975bdc.jpg" alt=""><br></p>'//商品描述
);

$class = array(
	array(
		'id' => 1, //栏目ID
		'classname' => '男装女装', //栏目名称
		'tabid' => 'nznz_1', //栏目TABID名称
		'list' => array( //该栏目的二级栏目
			array(
				'id' => 2, //栏目ID
				'classname' => '热卖选购', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 3, //栏目ID
						'classname' => '时尚羽绒', //子栏目名称
						'img' => 'https://img13.360buyimg.com/focus/jfs/t13111/296/562407882/5437/708e24a6/5a0ebc62Nec865e68.jpg' //子栏目的图片
					),
					array(
						'id' => 4, //栏目ID
						'classname' => '保暖棉服', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t13912/250/565576531/4969/64afff47/5a0ebc5cNe2bddf32.jpg' //子栏目的图片
					),
					array(
						'id' => 5, //栏目ID
						'classname' => '修身夹克', //子栏目名称
						'img' => 'https://img11.360buyimg.com/focus/jfs/t12559/159/597184401/2349/d2e74b56/5a0ebc54N07bbacf3.jpg' //子栏目的图片
					),
					array(
						'id' => 6, //栏目ID
						'classname' => '牛仔裤', //子栏目名称
						'img' => 'https://img20.360buyimg.com/focus/jfs/t11629/115/2055948200/3740/55436dda/5a0ebc4eN9436e96b.jpg' //子栏目的图片
					)	
				)
			),
			array(
				'id' => 7, //栏目ID
				'classname' => '女装', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 8, //栏目ID
						'classname' => '新款大衣', //子栏目名称
						'img' => 'https://img10.360buyimg.com/focus/jfs/t13465/116/726666318/2650/623a7359/5a12b23eNbc0d7a47.jpg' //子栏目的图片
					),
					array(
						'id' => 9, //栏目ID
						'classname' => '连衣裙', //子栏目名称
						'img' => 'https://img20.360buyimg.com/focus/jfs/t14179/99/752605750/2297/f82b2e3d/5a12b234N2259963f.jpg' //子栏目的图片
					),
					array(
						'id' => 10, //栏目ID
						'classname' => '针织衫', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t11794/114/2228059199/2529/60e8b474/5a12b21eN10fd877c.jpg' //子栏目的图片
					),
					array(
						'id' => 11, //栏目ID
						'classname' => '毛衣', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t13516/94/713391824/4978/97513273/5a12b228Nf46f2ff1.jpg' //子栏目的图片
					),
					array(
						'id' => 12, //栏目ID
						'classname' => '宽松卫衣', //子栏目名称
						'img' => 'https://img10.360buyimg.com/focus/jfs/t12772/63/745865953/4030/e85071ec/5a12b220N009d72a4.jpg' //子栏目的图片
					),
					array(
						'id' => 13, //栏目ID
						'classname' => '外套', //子栏目名称
						'img' => 'https://img13.360buyimg.com/focus/jfs/t13774/60/747129929/2709/b436419d/5a12b217N8470eba0.jpg' //子栏目的图片
					)
				)
			),
			array(
				'id' => 14, //栏目ID
				'classname' => '童装', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 15, //栏目ID
						'classname' => '品质童装', //子栏目名称
						'img' => 'https://img12.360buyimg.com/focus/jfs/t11257/255/2211172737/8332/3ef32977/5a12448aN04e0b987.jpg' //子栏目的图片
					),
					array(
						'id' => 16, //栏目ID
						'classname' => '套装', //子栏目名称
						'img' => 'https://img12.360buyimg.com/focus/jfs/t12442/247/704086578/7163/f0b3677d/5a12447fNd3894b27.jpg' //子栏目的图片
					),
					array(
						'id' => 17, //栏目ID
						'classname' => '裙子', //子栏目名称
						'img' => 'https://img10.360buyimg.com/focus/jfs/t13756/13/712950885/7910/6346b45/5a124475Nb3b9efd6.jpg' //子栏目的图片
					),
					array(
						'id' => 18, //栏目ID
						'classname' => '亲子装', //子栏目名称
						'img' => 'https://img12.360buyimg.com/focus/jfs/t11635/258/2210764394/12510/66bd58cf/5a12445bN917f40bb.jpg' //子栏目的图片
					)
				)
			),
		)
	),
	array(
		'id' => 19, //栏目ID
		'classname' => '男鞋女鞋', //栏目名称
		'tabid' => 'nxnx_19', //栏目TABID名称
		'list' => array( //该栏目的二级栏目
			array(
				'id' => 20, //栏目ID
				'classname' => '流行男鞋', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 21, //栏目ID
						'classname' => '休闲鞋', //子栏目名称
						'img' => 'https://img14.360buyimg.com/focus/jfs/t13807/314/786063079/2610/c0e7de7b/5a139490Nc7fa0e4a.jpg' //子栏目的图片
					),
					array(
						'id' => 22, //栏目ID
						'classname' => '商务鞋', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t13138/355/835254734/2223/adb0cd95/5a139489N23c871c6.jpg' //子栏目的图片
					),
					array(
						'id' => 23, //栏目ID
						'classname' => '正装鞋', //子栏目名称
						'img' => 'https://img20.360buyimg.com/focus/jfs/t13552/146/765573445/2431/4311417d/5a13947dN5d024b9f.jpg' //子栏目的图片
					),
					array(
						'id' => 24, //栏目ID
						'classname' => '帆布鞋', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t11992/144/2244194535/2627/3de251a9/5a139564Naee94e4a.jpg' //子栏目的图片
					)	
				)
			),
			array(
				'id' => 25, //栏目ID
				'classname' => '时尚女鞋', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 26, //栏目ID
						'classname' => '休闲鞋', //子栏目名称
						'img' => 'https://img12.360buyimg.com/focus/jfs/t11215/28/2255245076/2123/34893220/5a13f4c2N878e06ff.jpg' //子栏目的图片
					),
					array(
						'id' => 27, //栏目ID
						'classname' => '女靴', //子栏目名称
						'img' => 'https://img11.360buyimg.com/focus/jfs/t12391/56/793656945/6443/8dd29335/5a13f4bbN0109307e.jpg' //子栏目的图片
					),
					array(
						'id' => 28, //栏目ID
						'classname' => '短靴', //子栏目名称
						'img' => 'https://img11.360buyimg.com/focus/jfs/t12391/56/793656945/6443/8dd29335/5a13f4bbN0109307e.jpg' //子栏目的图片
					),
					array(
						'id' => 29, //栏目ID
						'classname' => '短靴', //子栏目名称
						'img' => 'https://img12.360buyimg.com/focus/jfs/t14071/40/787831338/2452/708b727c/5a13f4b4Ndd40587a.jpg' //子栏目的图片
					),
					array(
						'id' => 30, //栏目ID
						'classname' => '马丁靴', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t12115/73/819992685/2931/f6dd612a/5a13f4adN0116fe8b.jpg' //子栏目的图片
					),
					array(
						'id' => 31, //栏目ID
						'classname' => '帆布鞋', //子栏目名称
						'img' => 'https://img14.360buyimg.com/focus/jfs/t13090/47/771516189/4149/4e90042d/5a13f4a2Ndab62821.jpg' //子栏目的图片
					)
				)
			)
		)
	),
	array(
		'id' => 32, //栏目ID
		'classname' => '内衣配饰', //栏目名称
		'tabid' => 'nyps_32', //栏目TABID名称
		'list' => array( //该栏目的二级栏目
			array(
				'id' => 33, //栏目ID
				'classname' => '保暖内衣', //二级栏目名称
				'list' => array( //二级栏目下的子栏目
					array(
						'id' => 34, //栏目ID
						'classname' => '保暖内衣', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t11665/278/2197383506/8742/b3a23c67/5a151d25N2927b937.jpg' //子栏目的图片
					),
					array(
						'id' => 35, //栏目ID
						'classname' => '保暖裤', //子栏目名称
						'img' => 'https://img10.360buyimg.com/focus/jfs/t14194/47/842495430/4074/ecf95595/5a151c9fNcbf87576.jpg' //子栏目的图片
					),
					array(
						'id' => 36, //栏目ID
						'classname' => '男士保暖', //子栏目名称
						'img' => 'https://img10.360buyimg.com/focus/jfs/t13972/34/849982121/5216/58243ee9/5a151c97Nf6982faf.jpg' //子栏目的图片
					),
					array(
						'id' => 37, //栏目ID
						'classname' => '女士保暖', //子栏目名称
						'img' => 'https://img30.360buyimg.com/focus/jfs/t12475/176/848778869/6374/6375ca3d/5a151c91N7eb33b8a.jpg' //子栏目的图片
					)	
				)
			)
		)
	)
);

//商品列表
$goods_list = array(
	array(
		'id' => 50,//商品ID
		'title' => '耐克 NIKE WINDRUNNER 男子夹克外套 AJ7936 AJ7936-010黑 XL',//商品标题
		'stitle' => '黑 XL',//副标题
		'img' => '//img14.360buyimg.com/n2/s370x474_jfs/t27652/342/1058111672/146179/b715e30a/5bc0701aN69b61c96.jpg!cc_370x474!q70.jpg',//商品图片地址
		'price' => '395.00'//商品价格
	),
	array(
		'id' => 51,//商品ID
		'title' => '吉普(JEEP) 夹克 男士立领加绒卫衣2018秋季 新款',//商品标题
		'stitle' => '外套男装 宝蓝色  JK0044 L码',//副标题
		'img' => '//img11.360buyimg.com/mobilecms/s360x464_jfs/t25960/27/1756868983/341061/96914c6/5bbb22ecN1360529c.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '218.00'//商品价格
	),
	array(
		'id' => 52,//商品ID
		'title' => '尊尚鸟 夹克外套男士2018秋冬季新品 加厚韩版简约帅气纯色休闲百搭宽松男装 灰色 L',//商品标题
		'stitle' => '灰色 L',//副标题
		'img' => '//img12.360buyimg.com/mobilecms/s360x464_jfs/t1/5877/20/13494/73248/5bd863a1E8a7b3ac7/c2f663bc81167c4a.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '128.00'//商品价格
	),
	array(
		'id' => 53,//商品ID
		'title' => '花花公子夹克男外套秋冬新款青年时尚潮流男士',//商品标题
		'stitle' => '棒球衫上衣男装PLAYBOY 黑色加厚 XXL',//副标题
		'img' => '//img12.360buyimg.com/mobilecms/s360x464_jfs/t15841/351/1145193496/113174/de97171f/5a4b2f55N489fa1c8.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '218.00'//商品价格
	),
	array(
		'id' => 54,//商品ID
		'title' => 'AJ AIR JORDAN SPORTSWEAR WINGS 男子印花夹克外套 939969 939969-010黑 L',//商品标题
		'stitle' => '939969-010黑 L',//副标题
		'img' => '//img11.360buyimg.com/mobilecms/s360x464_jfs/t25918/325/1198568706/105785/a70287fc/5b8e30a5Nda2d89c3.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '499.00'//商品价格
	),
	array(
		'id' => 55,//商品ID
		'title' => 'HLA海澜之家连帽运动款夹克2018秋季新品纯色舒适夹克外套男HWJAJ3E509A 蓝灰AJ 175/92A/L',//商品标题
		'stitle' => '蓝灰AJ 175/92A/L',//副标题
		'img' => '//img10.360buyimg.com/mobilecms/s360x464_jfs/t1/2084/18/5189/245841/5b9f62cbE2aafe9b1/0bcbd11886792194.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '298.00'//商品价格
	),
	array(
		'id' => 53,//商品ID
		'title' => '花花公子夹克男外套秋冬新款青年时尚潮流男士',//商品标题
		'stitle' => '棒球衫上衣男装PLAYBOY 黑色加厚 XXL',//副标题
		'img' => '//img12.360buyimg.com/mobilecms/s360x464_jfs/t15841/351/1145193496/113174/de97171f/5a4b2f55N489fa1c8.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '218.00'//商品价格
	),
	array(
		'id' => 50,//商品ID
		'title' => '耐克 NIKE WINDRUNNER 男子夹克外套 AJ7936 AJ7936-010黑 XL',//商品标题
		'stitle' => '黑 XL',//副标题
		'img' => '//img14.360buyimg.com/n2/s370x474_jfs/t27652/342/1058111672/146179/b715e30a/5bc0701aN69b61c96.jpg!cc_370x474!q70.jpg',//商品图片地址
		'price' => '395.00'//商品价格
	),
	array(
		'id' => 54,//商品ID
		'title' => 'AJ AIR JORDAN SPORTSWEAR WINGS 男子印花夹克外套 939969 939969-010黑 L',//商品标题
		'stitle' => '939969-010黑 L',//副标题
		'img' => '//img11.360buyimg.com/mobilecms/s360x464_jfs/t25918/325/1198568706/105785/a70287fc/5b8e30a5Nda2d89c3.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '499.00'//商品价格
	),
	array(
		'id' => 55,//商品ID
		'title' => 'HLA海澜之家连帽运动款夹克2018秋季新品纯色舒适夹克外套男HWJAJ3E509A 蓝灰AJ 175/92A/L',//商品标题
		'stitle' => '蓝灰AJ 175/92A/L',//副标题
		'img' => '//img10.360buyimg.com/mobilecms/s360x464_jfs/t1/2084/18/5189/245841/5b9f62cbE2aafe9b1/0bcbd11886792194.jpg!cc_360x464!q70.dpg.webp',//商品图片地址
		'price' => '298.00'//商品价格
	)
);

$in_cart_goods = array(
	'pid' => 50,
	'ptitle' => "蓦兰 毛衣男高领针织衫男装 2018秋冬季新款套头线衣高领上衣外套潮流打底衫线衫衣服大码男装 卡其色 XL",
	'img' => "//img14.360buyimg.com/n2/s370x474_jfs/t1/6765/11/4054/287920/5bd7fbd6E591d8119/b41d976984bfcf5a.png",
	'price' => 185.00 
);


switch ($ac) {
	case 'banner'://获取BANNER列表
		//查询数据库数据
		echo json_encode($banner);
		exit;
		break;
	case 'news'://资讯
		//查询数据库数据
		echo json_encode($news);
		exit;
		break;
	case 'index_good'://首页商品列表
		//查询数据库数据
		echo json_encode($goods);
		exit;
		break;
	case 'get_goods'://获取单个商品的数据
		//查询数据库数据
		$errmsg=array('status' => false,'msg' => '未知错误');
		$id=intval($_GET['id']);//获取ID
		if(empty($id)){
			$errmsg['msg'] = '参数错误';
			echo json_encode($errmsg);
			exit;
		}
		echo json_encode($goods_item);
		break;
	case 'get_class'://获取分类信息
		//查询数据库数据，取得分类信息
		echo json_encode($class);
		exit;
		break;
	case 'get_good_list': //获取栏目相关列表
		//查询数据库数据，取得相关栏目的商品列表
		echo json_encode($goods_list);
		exit;
		break;
	case 'in_cart_goods': //获取要添加到购物车的商品信息

		echo json_encode($in_cart_goods);
		exit;
		break;
	default:
		# code...
		break;
}
