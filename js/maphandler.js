var mark = [];
var oldMark = [];
var checked=[];
  
function point(x, y){
    this.x = x;
    this.y = y;
}
function getOffset(obj){
    var x = 15, y = 19;
    x += obj.offset().left;
    y += obj.offset().top;
    return {x : x, y : y };
}
function addMark(p, x, y, index){
    newMark=$('<div></div>');
    newMark.addClass("mark");
    newMark.attr("id","mark"+index);
    newMark.css("left",x+"px");
    newMark.css("top",y+"px");
    newMark.css("background-image","url(css/rpin.png)");
    $("#container").append(newMark);
    
}

function setHover(mp){
	/*No hover setting yet.
	mp.hover(
		function(){
			mp.css("background-image","url(css/gpin.png)");
		},
		function(){
			mp.css("background-image","url(css/rpin.png)");
		}
	)	
	*/
}

function removeHover(mp){
	/*No hover yet.
	mp.hover(
		function(){
			mp.css("background-image","url(css/gpin.png)");
		},
		function(){
			mp.css("background-image","url(css/gpin.png)");
		}
	)
	*/
}

function addOldMark(idx,item){
	var newOldMark=$('<div title="'+item.name+'"></div>');
	newOldMark.addClass("mark");
	newOldMark.attr("id","oldMark"+idx);
	newOldMark.css("left",item.lng+"px");
	newOldMark.css("top",item.lat+"px");
	/*
	 * 0:黑色
	 * 1:橙色
	 * 2:绿色
	 * 3:红色闪烁
	 */
	newOldMark.css("background-image","url(css/bpin.png)");
	if (item.state==0){
		newOldMark.css("background-image","url(css/bpin.png)");
	}else if (item.state==1){
		newOldMark.css("background-image","url(css/opin.png)");
	}else if (item.state==2){
		newOldMark.css("background-image","url(css/gpin.png)");
	}else if (item.state==3){
		newOldMark.css("background-image","url(css/rpin.png)");
	}
	setHover(newOldMark);
	checked[idx]=false;
	
	newOldMark.click(function(){
			if (checked[idx]){
				//newOldMark.css("background-image","url(css/rpin.png)");
				//setHover(newOldMark);
				checked[idx]=false;
			}else{
				//newOldMark.css("background-image","url(css/gpin.png)");
				//removeHover(newOldMark);
				checked[idx]=true;
			}
			if (typeof($("#sendto").val())!="undefined"){
				var sendtoStr="";
				for (var c=0;c<checked.length;c++){
					if (checked[c]){
						if (sendtoStr!="")
							sendtoStr+=",";
						sendtoStr+=oldMark[c].tel;
					}
				}
				$("#sendto").val(sendtoStr);
			}
	})
	
	$("#container").append(newOldMark);
}

function bindEvent(){
    $("#map").dblclick(function(event){
        clearMark();
        
        var container = $("#container");
        var offset = getOffset(container);
        var x =  event.pageX-offset.x;
        var y =  event.pageY-offset.y;
        
        addMark(container, x, y, mark.length);
		$("#Map_lng").val(x);
		$("#Map_lat").val(y);
		$("#Map_lng").attr("readonly","readonly");
		$("#Map_lat").attr("readonly","readonly");
  
        mark.push(x + "," + y);       
    });
}
 
function loadMark(){
    $.get("http://localhost/senluomessager/index.php?r=map/getjsonnodes",function(data){
    	data=eval("("+data+")");
    	$.each(data,function(idx,item){
    		addOldMark(idx,item);
    		oldMark.push(item);
    	});
    });
}

function clearMark(){
    
    for(var i=0; i<mark.length; i++){
    	$("#mark"+i).detach();
    }
    mark = [];
 }