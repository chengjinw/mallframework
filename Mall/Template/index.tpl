<!-- 引入外层模板 start -->
<%extends file="home_layout.tpl"%> 
<!-- 引入外层模板 end -->

<!--    本页专属css start  -->
<%block name="append_css"%>
<link rel="stylesheet" type="text/css" href="{$smarty.const.MODULE_ASSET}/css/home/index.css">
<style type="text/css">
	.container{
		width: 900px;
		height: 500px;
		padding: 0 auto;
		background-color: #faa;
	}
</style>
<%/block%>
<!--    本页专属css end  -->

<!--    本页专属js start  -->
<%block name="append_js"%>
<script type="text/javascript" src="{$smarty.const.MODULE_ASSET}/js/home/index.js"></script>
<script type="text/javascript">
	console.log('hello');
</script>
<%/block%>
<!--    本页专属js end  -->

<!--    本页专属内容 start  -->
<%block name="container"%>
	<div class="container">
		I'm container
		asdasd
		<p>just:<%$test%></p>
	</div>
<%/block%>
<!--    本页专属内容 end  -->

	