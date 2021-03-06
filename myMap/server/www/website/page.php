<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>分页</title>
    <style type="text/css">
        .In-table
        {width: 350px; height: 100%; border: 1px solid #111; }
        #div-button
        { margin-bottom: 5px; }
        #div-button input
        {  border: 1px solid #9cf; box-shadow: 2px 2px 3px #ccc; border-radius: 5px;background: #9cf; }
    </style>
</head>
<body>
      每页显示<input type="text" id="PageNo" size="3" value="3"/>行<br/>
      总共<span id="s1"></span>页
      当前第<span id="s2"></span>页
      <div id="div-button">
      <input type="button" value="首页" id="F-page">
      <input type="button" value="下一页" id="Nex-page">
      <input type="button" value="上一页" id="Pre-page">
      <input type="button" value="尾页" id="L-page">
      </div>
          <table id="input-table" class="In-table" border="1">
          </table>
      <script type="text/javascript">
          var dataArray=[
              ["赵云","男","48"],
              ["林冲","男","40"],
              ["貂蝉","女","20"],
              ["程咬金","男","42"],
              ["元芳","男","35"],
              ["关羽","男","40"],
              ["张飞","男","39"],
              ["李白","男","41"],
              ["马超","男","28"],
              ["黄忠","男","65"],
              ["魏延","男","25"],
              ["杨贵妃","女","22"],
              ["武则天","女","24"],
              ["陈到","男","40"],
              ["姜维","男","2"],
              ["凤姐","女","22"],
              ["犀利哥","男","35"],
              ["本拉登","男","25"],
              ["春哥","你猜","22"],
              ["孔子","男","68"],
              ["老子","男","58"],
              ["孟子他妈","女","48"]];
              var PageNo=document.getElementById('PageNo');                   //设置每页显示行数
              var InTb=document.getElementById('input-table');               //表格
              var Fp=document.getElementById('F-page');                      //首页
              var Nep=document.getElementById('Nex-page');                  //下一页
              var Prp=document.getElementById('Pre-page');                  //上一页
              var Lp=document.getElementById('L-page');                     //尾页
              var S1=document.getElementById('s1');                         //总页数
              var S2=document.getElementById('s2');                         //当前页数
              var currentPage;                                              //定义变量表示当前页数
              var SumPage;                                                  //定义变量表示总页数
              Fp.onclick=function()
              {

                  if(PageNo.value!="")                                       //判断每页显示是否为空
                  {
                      InTb.innerHTML='';                                     //每次进来都清空表格
                      S2.innerHTML='';                                        //每次进来清空当前页数
                      currentPage=1;                                          //首页为1
                      S2.appendChild(document.createTextNode(currentPage));
                      S1.innerHTML='';                                        //每次进来清空总页数
                      if(dataArray.length%PageNo.value==0)                    //判断总的页数
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value);
                      }
                      else
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value)+1
                      }
                      S1.appendChild(document.createTextNode(SumPage));
                      var oTBody=document.createElement('tbody');               //创建tbody
                      oTBody.setAttribute('class','In-table');                   //定义class
                      oTBody.insertRow(0);
                      oTBody.rows[0].insertCell(0);
                      oTBody.rows[0].cells[0].appendChild(document.createTextNode('姓名'));
                      oTBody.rows[0].insertCell(1);
                      oTBody.rows[0].cells[1].appendChild(document.createTextNode('性别'));
                      oTBody.rows[0].insertCell(2);
                      oTBody.rows[0].cells[2].appendChild(document.createTextNode('年龄'));
                      InTb.appendChild(oTBody);                                     //将创建的tbody添加入table
                      for(i=0;i<parseInt(PageNo.value);i++)
                      {                                                          //循环打印数组值
                          oTBody.insertRow(i+1);
                          for(j=0;j<dataArray[i].length;j++)
                          {
                              oTBody.rows[i+1].insertCell(j);
                              oTBody.rows[i+1].cells[j].appendChild(document.createTextNode(dataArray[i][j]));
                          }
                      }
                  }
              }
              Nep.onclick=function()
              {
                  if(currentPage<SumPage)                                 //判断当前页数小于总页数
                  {
                      InTb.innerHTML='';
                      S1.innerHTML='';
                      if(dataArray.length%PageNo.value==0)
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value);
                      }
                      else
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value)+1
                      }
                      S1.appendChild(document.createTextNode(SumPage));
                      S2.innerHTML='';
                      currentPage=currentPage+1;
                      S2.appendChild(document.createTextNode(currentPage));
                      var oTBody=document.createElement('tbody');
                      oTBody.setAttribute('class','In-table');
                      oTBody.insertRow(0);
                      oTBody.rows[0].insertCell(0);
                      oTBody.rows[0].cells[0].appendChild(document.createTextNode('姓名'));
                      oTBody.rows[0].insertCell(1);
                      oTBody.rows[0].cells[1].appendChild(document.createTextNode('性别'));
                      oTBody.rows[0].insertCell(2);
                      oTBody.rows[0].cells[2].appendChild(document.createTextNode('年龄'));
                      InTb.appendChild(oTBody);
                      var a;                                                 //定义变量a
                      a=PageNo.value*(currentPage-1);                       //a等于每页显示的行数乘以上一页数
                      var c;                                                  //定义变量c
                      if(dataArray.length-a>=PageNo.value)                  //判断下一页数组数据是否小于每页显示行数
                      {
                          c=PageNo.value;
                      }
                      else
                      {
                          c=dataArray.length-a;
                      }
                      for(i=0;i<c;i++)
                      {
                          oTBody.insertRow(i+1);
                          for(j=0;j<dataArray[i].length;j++)
                          {

                              oTBody.rows[i+1].insertCell(j);
                              oTBody.rows[i+1].cells[j].appendChild(document.createTextNode(dataArray[i+a][j]));
                          }                                                            //数组从第i+a开始取值
                      }
                  }
              }

              Prp.onclick=function()
              {
                  if(currentPage>1)                        //判断当前是否在第一页
                  {
                      InTb.innerHTML='';
                      S1.innerHTML='';
                      if(dataArray.length%PageNo.value==0)
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value);
                      }
                      else
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value)+1
                      }
                      S1.appendChild(document.createTextNode(SumPage));
                      S2.innerHTML='';
                      currentPage=currentPage-1;
                      S2.appendChild(document.createTextNode(currentPage));
                      var oTBody=document.createElement('tbody');
                      oTBody.setAttribute('class','In-table');
                      oTBody.insertRow(0);
                      oTBody.rows[0].insertCell(0);
                      oTBody.rows[0].cells[0].appendChild(document.createTextNode('姓名'));
                      oTBody.rows[0].insertCell(1);
                      oTBody.rows[0].cells[1].appendChild(document.createTextNode('性别'));
                      oTBody.rows[0].insertCell(2);
                      oTBody.rows[0].cells[2].appendChild(document.createTextNode('年龄'));
                      InTb.appendChild(oTBody);
                      var a;
                      a=PageNo.value*(currentPage-1);
                      for(i=0;i<parseInt(PageNo.value);i++)
                      {
                          oTBody.insertRow(i+1);
                          for(j=0;j<dataArray[i].length;j++)
                          {

                              oTBody.rows[i+1].insertCell(j);
                              oTBody.rows[i+1].cells[j].appendChild(document.createTextNode(dataArray[i+a][j]));
                          }
                      }
                  }
              }

               Lp.onclick=function()
              {
                      InTb.innerHTML='';
                      S1.innerHTML='';
                      if(dataArray.length%PageNo.value==0)
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value);
                      }
                      else
                      {
                          SumPage=parseInt(dataArray.length/PageNo.value)+1
                      }
                      S1.appendChild(document.createTextNode(SumPage));
                      S2.innerHTML='';
                      currentPage=SumPage;
                      S2.appendChild(document.createTextNode(currentPage));
                      var oTBody=document.createElement('tbody');
                      oTBody.setAttribute('class','In-table');
                      oTBody.insertRow(0);
                      oTBody.rows[0].insertCell(0);
                      oTBody.rows[0].cells[0].appendChild(document.createTextNode('姓名'));
                      oTBody.rows[0].insertCell(1);
                      oTBody.rows[0].cells[1].appendChild(document.createTextNode('性别'));
                      oTBody.rows[0].insertCell(2);
                      oTBody.rows[0].cells[2].appendChild(document.createTextNode('年龄'));
                      InTb.appendChild(oTBody);
                      var a;
                      a=PageNo.value*(currentPage-1);
                      var c;
                      if(dataArray.length-a>=PageNo.value)
                      {
                          c=PageNo.value;
                      }
                      else
                      {
                          c=dataArray.length-a;
                      }
                      for(i=0;i<c;i++)
                      {
                          oTBody.insertRow(i+1);
                          for(j=0;j<dataArray[i].length;j++)
                          {

                              oTBody.rows[i+1].insertCell(j);
                              oTBody.rows[i+1].cells[j].appendChild(document.createTextNode(dataArray[i+a][j]));
                          }
                      }
              }
      </script>
</body>
</html>