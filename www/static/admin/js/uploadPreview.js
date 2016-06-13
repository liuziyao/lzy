	function checkPic(){
		var picPath=document.getElementById("picPath").value;
		var type=picPath.substring(picPath.lastIndexOf(".")+1,picPath.length).toLowerCase();
		if(type!="jpg"&&type!="bmp"&&type!="gif"&&type!="png"){
			alert("请上传正确的图片格式");
			return false;
		}
		return true;
	}
			//图片预览
	function PreviewImage(divImage,upload,width,height) {
		//alert(divImage+upload+width+height);
		//if(checkPic()){
			//try{
				var imgPath; 
				 //图片路径     
				var Browser_Agent=navigator.userAgent;
				//判断浏览器的类型   
				if(Browser_Agent.indexOf("Firefox")!=-1){
					//火狐浏览器
					//imgPath = upload.files[0].getAsDataURL(); 
					//alert(upload.files[0.getAsDataURL()]);
					imgPath=window.URL.createObjectURL(upload.files[0]);
					document.getElementById(divImage).innerHTML = "<img id='imgPreview' src='"+imgPath+"' width='"+width+"' height='"+height+"'/>";
				}else{
					//IE浏览器
					var Preview = document.getElementById(divImage);
					Preview.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = upload.value;
					Preview.style.width = width;
					Preview.style.height = height;
				}  
			//}catch(e){
			//	alert("请上传正确的图片格式");
			//}
		//}else{
			//alert(divImage+upload+width+height);
		//} 
	}