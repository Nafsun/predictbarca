$(function(){
	$("#barcelona-appear").hide();
	$("#barcelona-appear-2").hide();
	$("#menu-phone").hide();
	$("#predict-display").hide();
	$("#trophies-display").hide();
	$("#edit-profile-display").hide();
	$("#livechat-display").hide();
	$("#commentry-display").hide();
	$("#show-on-click-edit-profile").hide();
	$("#show-on-click-change-password").hide();
	$("#all-pages-updates").hide();
	$("#all-pages-squad").hide();
	$("#edit-pa").click(function(){
		$("#all-pages-updates").slideToggle();
	});
	$("#brcl").click(function(){
		$("#barcelona-appear").slideToggle();
	});
	$("#brcl2").click(function(){
		$("#barcelona-appear-2").slideToggle();
	});
	$("#mps").click(function(){
		$("#barcelona-appear-2").hide();
		$("#menu-phone").slideToggle();
	});
	$("#hom").click(function(){
		$("#home-display").show();
		$("#predict-display").hide();
		$("#trophies-display").hide();
		$("#edit-profile-display").hide();
		$("#livechat-display").hide();
		$("#commentry-display").hide();
	});
	$("#pre").click(function(){
		$("#home-display").hide();
		$("#predict-display").show();
		$("#trophies-display").hide();
		$("#edit-profile-display").hide();
		$("#livechat-display").hide();
		$("#commentry-display").hide();
	});
	$("#tro").click(function(){
		$("#home-display").hide();
		$("#predict-display").hide();
		$("#trophies-display").show();
		$("#edit-profile-display").hide();
		$("#livechat-display").hide();
		$("#commentry-display").hide();
	});
	$("#edp").click(function(){
		$("#home-display").hide();
		$("#predict-display").hide();
		$("#trophies-display").hide();
		$("#edit-profile-display").show();
		$("#livechat-display").hide();
		$("#commentry-display").hide();
	});
	$("#livechat").click(function(){
		$("#home-display").hide();
		$("#predict-display").hide();
		$("#trophies-display").hide();
		$("#edit-profile-display").hide();
		$("#livechat-display").show();
		$("#commentry-display").hide();
	});
	$("#livecom").click(function(){
		$("#home-display").hide();
		$("#predict-display").hide();
		$("#trophies-display").hide();
		$("#edit-profile-display").hide();
		$("#livechat-display").hide();
		$("#commentry-display").show();
	});
	$(".predict-match").click(function(){
		$("#home-display").hide();
		$("#predict-display").show();
		$("#trophies-display").hide();
		$("#edit-profile-display").hide();
		$("#livechat-display").hide();
		$("#commentry-display").hide();
	});
	$("#edit-change-click").click(function(){
		$("#show-on-click-edit-profile").slideToggle();
	});
	$("#password-change-click").click(function(){
		$("#show-on-click-change-password").slideToggle();
	});
	$("#edit-squad").click(function(){
		$("#all-pages-squad").slideToggle();
	});
});