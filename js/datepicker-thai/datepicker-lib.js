
function picker_date(element,option)
{
    $(element).prop("readonly",true);
    $(element).css("background-color","white");



    var ran_cal_id=null;

    ran_cal_id=Math.random()*100000;
    ran_cal_id=ran_cal_id.toString().split(".")[0];
    ran_cal_id="cal"+ran_cal_id;

    while($("."+ran_cal_id).length!=0)
    {
        ran_cal_id=Math.random()*100000;
        ran_cal_id=ran_cal_id.toString().split(".")[0];
        ran_cal_id="cal"+ran_cal_id;
    }

    $(element).attr("data-picker",ran_cal_id);
    $(element).addClass(ran_cal_id);

    var sel_pic_cal=function(ran_cal_id,td)
    {

        var date=$(td).html();
        if(date=="")
        {
            return;
        }

        var m=$("[data-picker="+ran_cal_id+"]").next().find(".month_select").val();
        var y=parseInt($("[data-picker="+ran_cal_id+"]").next().find(".year_select").val())+543;
        y=y.toString();

        date=date+"/"+m+"/"+y;


        $("[data-picker="+ran_cal_id+"]").val(date);
        $("[data-picker="+ran_cal_id+"]").attr("sel_val",date);
        $("[data-picker="+ran_cal_id+"]").next().remove();


        if(option.onchange!=null)
        {
            option.onchange(date);
        }
    }

    var render_cal_pic=function(element,month,year)
    {

        var html;

        html="";

        html+="<table class='table table-sm' >";

        html+="<thead>";

        html+="<tr class='table-active'>";


/*
        html+="<th>จันทร์</th>";
        html+="<th>อังคาร</th>";
        html+="<th>พุธ</th>";
        html+="<th>พฤหัส</th>";
        html+="<th>ศุกร์</th>";
        html+="<th>เสาร์</th>";
        html+="<th>อาทิตย์</th>";
*/


        html+="</tr>";

        html+="</thead>";






        var d1=new Date(year,month-1,1);

        html+="<tbody>";


        if(d1.getDay()==0) { html+="<tr>"; }
        if(d1.getDay()==1) { html+="<tr><td></td>";}
        if(d1.getDay()==2) { html+="<tr><td></td><td></td>";}
        if(d1.getDay()==3) { html+="<tr><td></td><td></td><td></td>";}
        if(d1.getDay()==4) { html+="<tr><td></td><td></td><td></td><td></td>";}
        if(d1.getDay()==5) { html+="<tr><td></td><td></td><td></td><td></td><td></td>";}
        if(d1.getDay()==6) { html+="<tr><td></td><td></td><td></td><td></td><td></td><td></td>";}


        while((d1.getMonth()+1)==month)
        {

            if(d1.getDay()==0 && d1.getDate()!=1 ) {
                html+="<tr>";
            }

            var to_day=new Date();

            var date_str=d1.getDate().toString();
            if(date_str.length==1){date_str="0"+date_str;}

            var date_month=(d1.getMonth()+1).toString();
            if(date_month.length==1){date_month="0"+date_month;}

            var date_year=d1.getFullYear().toString();
            if(date_year.length==1){date_year="0"+date_year;}

            date_str=date_year+"-"+date_month+"-"+date_str;

            var str_d=d1.getDate().toString();
            if(str_d.length==1)
            {
                str_d="0"+str_d;
            }

            var today_class="";

            if(
                to_day.getDate()==d1.getDate() &&
                to_day.getMonth()==d1.getMonth()  &&
                to_day.getFullYear()==d1.getFullYear()
            )
            {
                today_class=" class='text-danger'";
            }

            var onclick="";

            html+="<td "+onclick+" onmouseover=\"this.style.cursor='pointer'\" onmouseout=\"this.style.cursor=''\" "+today_class+" >"+str_d+"</td>";



            if(d1.getDay()==6) {
                html+="</tr>";
            }

            d1.setDate(d1.getDate()+1);
        }

        while(d1.getDay()!=0)
        {
            html+="<td></td>";
            d1.setDate(d1.getDate()+1);
        }

        if(html.substr(html.length-5)!="</tr>")
        {
            html+="</tr>";
        }

        //html+="<td colspan='7' >";

        //html+="<button class='btn btn-sm btn-danger clear_cal_btn' onclick='$(\"[data-picker="+ran_cal_id+"]\").val(\"\");$(\"[data-picker="+ran_cal_id+"]\").next().remove();'>";
        //html+="<button class='btn btn-sm btn-danger clear_cal_btn' >";
        //html+="<i class='fa fa-times' ></i> ล้างข้อมูลปฏิทิน";
        //html+="</button>";

        //html+="</td>";

        html+="</tbody>";



        html+="</table>";

        html+="<button class='btn btn-sm btn-danger clear_cal_btn' >";
        html+="<i class='fa fa-times' ></i> ล้างข้อมูลปฏิทิน";
        html+="</button>";




        return html;


    }

    var change_mon_year_cal_pic=function(ran_cal_id)
    {

        var html=render_cal_pic(
            element,
            parseInt( $("."+ran_cal_id+"_panel").find(".month_select").val() ),
            parseInt( $("."+ran_cal_id+"_panel").find(".year_select").val() )
        );
        $("."+ran_cal_id+"_panel").find(".clear_cal_btn").remove();
        $("."+ran_cal_id+"_panel").find("table").remove();
        $("."+ran_cal_id+"_panel").append(html);

        $("."+ran_cal_id+"_panel").find("td").on("click",function(){
            sel_pic_cal(ran_cal_id,this);
        });

        $(element).next().find(".clear_cal_btn").on('click',function(){
            //alert('');
            if(option.onchange!=null)
            {
                option.onchange("");
            }

            $("[data-picker="+ran_cal_id+"]").val("");
            $("[data-picker="+ran_cal_id+"]").next().remove();


        });


    }

    //$(element).on("click",()=>{
    $("[data-picker="+ran_cal_id+"]").on("click",function (){


        if(document.querySelector("."+ran_cal_id+"_panel"))
        {
            $("."+ran_cal_id+"_panel").remove();
            return;
        }
        var html="";


        if(this.value!="" && this.value!=null )
        {
            var date_arr=this.value.split("/");
            html=render_cal_pic(element,date_arr[1],parseInt(date_arr[2])-543);

        }
        else
        {
            html=render_cal_pic(element,(new Date()).getMonth()+1,(new Date()).getFullYear());
        }



        var cal=document.createElement("div");
        $(cal).addClass(ran_cal_id+"_panel");

        var filter_panel=document.createElement("div");
        $(filter_panel).css("padding","10px");
        $(filter_panel).addClass("row");

        var select_panel1=document.createElement("div");
        $(select_panel1).addClass("col");

        var select_panel2=document.createElement("div");
        $(select_panel2).addClass("col");

        var month_select=document.createElement("select");
        $(month_select).addClass("month_select");
        $(month_select).addClass("form-control");
        $(select_panel1).append(month_select);

        $(month_select).append("<option value='01' >มกราคม</option>");
        $(month_select).append("<option value='02' >กุมภาพันธ์</option>");
        $(month_select).append("<option value='03' >มีนาคม</option>");
        $(month_select).append("<option value='04' >เมษายน</option>");
        $(month_select).append("<option value='05' >พฤษภาคม</option>");
        $(month_select).append("<option value='06' >มิถุนายน</option>");
        $(month_select).append("<option value='07' >กรกฎาคม</option>");
        $(month_select).append("<option value='08' >สิงหาคม</option>");
        $(month_select).append("<option value='09' >กันยายน</option>");
        $(month_select).append("<option value='10' >ตุลาคม</option>");
        $(month_select).append("<option value='11' >พฤศจิกายน</option>");
        $(month_select).append("<option value='12' >ธันวาคม</option>");

        var year_select=document.createElement("select");
        $(year_select).addClass("year_select");
        $(year_select).addClass("form-control");
        $(select_panel2).append(year_select);


        $(select_panel1).append(month_select);
        $(select_panel2).append(year_select);

        var year_now=(new Date()).getFullYear();
        var month_now=(new Date()).getMonth()+1;
        var year_range;

        if(option.year_range!=null)
        {
            year_range=option.year_range;
        }
        else
        {
            year_range="-50:+50";
        }

        var year1=year_now+parseInt(year_range.split(":")[0]);
        var year2=year_now+parseInt(year_range.split(":")[1]);

        while(year1<=year2)
        {
            $(year_select).append("<option value='"+year1+"' >"+(year1+543).toString()+"</option>");
            year1++;
        }

        //if( element.value!=null && element.value!="")
        if(this.value!="" && this.value!=null)
        {
            var date_arr=this.value.split("/");

            $(month_select).val(date_arr[1]);
            $(year_select).val(parseInt(date_arr[2])-543);
        }
        else
        {
            month_now=month_now.toString();
            if(month_now.length==1)
            {
                month_now="0"+month_now;
            }
            $(month_select).val(month_now);
            $(year_select).val(year_now);
        }

        $(month_select).on("change",function(){change_mon_year_cal_pic(ran_cal_id)});
        $(year_select).on("change",function(){change_mon_year_cal_pic(ran_cal_id)});

        var left_btn=document.createElement("button");
        $(left_btn).prop("type","button");
        $(left_btn).addClass("btn");
        $(left_btn).addClass("btn-sm");
        $(left_btn).addClass("btn-primary");
        $(left_btn).html("<i class='fa fa-chevron-left' ></i>");
        $(left_btn).on("click",function(){

            var m=parseInt($("."+ran_cal_id+"_panel").find(".month_select").val());
            m--;
            if(m==0)
            {

                m=12;
                var y=parseInt($("."+ran_cal_id+"_panel").find(".year_select").val());
                y--;
                $("."+ran_cal_id+"_panel").find(".year_select").val(y);
            }

            m=m.toString();
            if(m.length==1)
            {
                m="0"+m;
            }


            $("."+ran_cal_id+"_panel").find(".month_select").val(m);

            change_mon_year_cal_pic(ran_cal_id);
        });

        var right_btn=document.createElement("button");
        $(right_btn).prop("type","button");
        $(right_btn).addClass("btn");
        $(right_btn).addClass("btn-sm");
        $(right_btn).addClass("btn-primary");
        $(right_btn).html("<i class='fa fa-chevron-right' ></i>");
        $(right_btn).on("click",function(){

            var m=parseInt($("."+ran_cal_id+"_panel").find(".month_select").val());
            m++;
            if(m==13)
            {

                m=1;
                var y=parseInt($("."+ran_cal_id+"_panel").find(".year_select").val());
                y++;
                $("."+ran_cal_id+"_panel").find(".year_select").val(y);
            }

            m=m.toString();
            if(m.length==1)
            {
                m="0"+m;
            }


            $("."+ran_cal_id+"_panel").find(".month_select").val(m);

            change_mon_year_cal_pic(ran_cal_id);
        });

        $(filter_panel).append(left_btn);
        $(filter_panel).append(select_panel1);
        $(filter_panel).append(select_panel2);
        $(filter_panel).append(right_btn);

        $(cal).append(filter_panel);
        $(cal).append(html);

        $(element).after(cal);
        $(element).next().find("td").on("click",function(){

            sel_pic_cal(ran_cal_id,this);



        });

        $(element).next().find(".clear_cal_btn").on('click',function(){
            //alert('');
            if(option.onchange!=null)
            {
                option.onchange("");
            }

            $("[data-picker="+ran_cal_id+"]").val("");
            $("[data-picker="+ran_cal_id+"]").next().remove();


        });

        /*var clear_btn=document.createElement("button");
         $(clear_btn).addClass("btn");
         $(clear_btn).addClass("btn-danger");
         $(clear_btn).addClass("btn-sm");
         $(clear_btn).html(" <i class='fa fa-times' ></i> ล้างข้อมูลปฏิทิน");
         $(clear_btn).on("click",()=>{

         });
         $(cal).append(clear_btn);*/


    });

}