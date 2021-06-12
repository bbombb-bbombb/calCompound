<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="2.9.4chart.js"></script>
<script type="text/javascript" src="javascript/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="w3.css">


<body onload="startPage()">

<?php
include("simple_html_dom.php");

// create curl resource
/*
       error_reporting(E_ALL);
ini_set('display_errors', true);
       $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, 'https://bscscan.com/');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($ch, CURLOPT_SSLVERSION, 4);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
*/
//$crawler = $client->request('GET', 'https://google.com/');
//$fullPageHtml = $crawler->html();
//$pageH1 = $crawler->filter('h1')->text();
// Create DOM from URL or file

$html = file_get_html('https://www.worldcoinindex.com/th/%E0%B9%80%E0%B8%AB%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%8D/dopple-finance');
$extractFromWeb=$html->find('body .col-md-6 .coinprice',0)->plaintext;
$dopPrice=substr($extractFromWeb, 2);

$html = file_get_html('https://www.worldcoinindex.com/th/%E0%B9%80%E0%B8%AB%E0%B8%A3%E0%B8%B5%E0%B8%A2%E0%B8%8D/binancecoin');
$extractFromWeb=$html->find('body .col-md-6 .coinprice',0)->plaintext;
$bnbPrice=substr($extractFromWeb, 2);

// Find all article blocks

echo $html;
//echo $html = file_get_html('https://bscscan.com/address/0x0243A20B20ECa78ddEDF6b8ddb43a0286438A67A');


/*
$html = file_get_contents('https://en.wikipedia.org/wiki/December_10');

$start = stripos($html, 'id="Births"');

$end = stripos($html, '</ul>', $offset = $start);

$length = $end - $start;

$htmlSection = substr($html, $start, $length);

echo $htmlSection;
*/

//$html = file_get_html('https://bscscan.com/address/0x830e287ac5947B1C0DA865dfB3Afd7CdF7900464');
//$ret = $html->find('a', 0);
//$extractFromWeb=$html->find('h1',0);
//$tvl=substr($extractFromWeb, 2);
//echo $ret;
?>
<!--<canvas id="myChart" style="width:100%;max-width:700px"></canvas>-->
<table>
    <tr><td>Start 2 POOLS LP Amount</td><td><input type="number" id="startAmount" name="startAmount" value="6000" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();" style="width: 70px;">$</td><td>APR 2 POOLS LP</td><td><input type="number" id="apr" name="apr" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();"  style="width: 70px;">%</td>
        <td>Dop price at start </td><td><input type="number" id="dopPrice" name="dopPrice" style="width: 70px;">$</td>
        <td>Dop price at end</td><td><input type="number" id="dopPriceEnd" name="dopPriceEnd" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();" style="width: 70px;">$</td></tr>

    <tr><td>Start DOP-BUSD LP Amount</td><td><input type="number" id="startAmountDB" name="startAmountDB" value="1000" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();" style="width: 70px;"> $</td><td>APR DOP-BUSD LPS</td><td><input type="number" id="aprDB" name="aprDB" value="400" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();"  style="width: 70px;">%</td></tr>
    <tr><td>Total gas fee</td><td><input type="number" id="totalGasFee" name="totalGasFee" disabled onchange="changeValue()"  style="width: 70px;">$</td>
        <td>BNB price</td><td><input type="number" id="bnbPrice" name="bnbPrice" onchange="changeValue()"  style="width: 70px;">$</td>
        <td>gas fee</td><td><input type="number" id="gasFee" name="gasFee" value=0.005 onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();"  style="width: 70px;">BNB</td></tr>
    <tr><td>want to see last amount at day </td><td><input type="number" id="lastDay" name="lastDay" value="60" onchange="changeValue();changeValue2();combineDOPwithDOPBUSD();combineDOPwithBUSD();"  style="width: 70px;"> (last day)</td></tr></table>
</table>

<p id="test"></p>
<center>
    <div class="w3-container" style="max-width: 1100px">
        <div class="w3-container w3-card w3-center">
                <div class="w3-container w3-half">
                    <canvas id="myChart" style="max-width:500px;max-height: 500px"></canvas>
                </div>
                <div class="w3-container w3-half">
                    <canvas id="myChart2" style="max-width:500px;max-height: 500px"></canvas>
                </div>
                <div class="w3-container w3-padding">
                    <table></table><tr><td>Best Compound every</td><td><input type="number" id="bestCompoundAt" name="bestCompoundAt" style="width: 70px;" onchange="changeGraph()" >days and</td>
                        <td>you will get </td><td><input type="number" id="bestCompound" name="bestCompound" style="width: 70px;" disabled> $ at lastDay with total profit of <td><input type="number" id="profit" name="profit"></td></td></tr></table>
                </div>
        </div>
    </div>
</center>

<center>
    <div class="w3-container w3-padding" style="max-width: 1100px">
        <div class="w3-container w3-card w3-center">
            <div class="w3-container w3-half">
                <canvas id="myChart3" style="max-width:500px;max-height: 500px"></canvas>
            </div>
            <div class="w3-container w3-half">
                <canvas id="myChart4" style="max-width:500px;max-height: 500px"></canvas>
            </div>
            <div class="w3-container w3-padding">
                <table></table><tr><td>Best Compound every</td><td><input type="number" id="bestCompoundAtDB" name="bestCompoundAtDB" style="width: 70px;" onchange="changeGraph2();combineDOPwithDOPBUSD();combineDOPwithBUSD();" >days or when you earn at least <input type="number" id="bestCompoundAtDBDop" name="bestCompoundAtDBDop" style="width: 70px;">DOP (~<input type="number" id="bestCompoundAtDBDopBusd" name="bestCompoundAtDBDopBusd" style="width: 70px;">)$ <br>
                        <td>and you will get </td><td><input type="number" id="bestCompoundDB" name="bestCompoundDB" style="width: 70px;" disabled> $ at lastDay with total profit of <td><input type="number" id="profitDB" name="profitDB"></td></td></tr></table>
            </div>
    </div>
</div>
</center>






<table></table><tr><td>Combining the profit from 2 pool and DOP-BUSD POOl you will get</td>
                   <td><input type="number" id="bestCompoundDBwB" name="bestCompoundDBwB" style="width: 70px;" disabled> $ at lastDay with total profit of <td><input type="number" id="profitDBwB" name="profitDBwB"></td></td></tr></table>






<canvas id="myChart5" style="max-width:500px;max-height: 500px"></canvas>
<table></table><tr><td>Combining the profit from 2 pool and DOP-BUSD POOl you will get</td>
                   <td><input type="number" id="bestCompoundDBb" name="bestCompoundDBb" style="width: 70px;" disabled> $ at lastDay total with profit of <td><input type="number" id="profitDBb" name="profitDBb"></td></td></tr></table>
<canvas id="myChart6" style="max-width:500px;max-height: 500px"></canvas>








<script type="text/javascript">
var dopPrice,bnbPrice;
function startPage(){
    dopPrice="<?php echo $dopPrice;?>"; //scrap data from other website
    document.getElementById("dopPrice").value=Number(dopPrice).toFixed(2);
    document.getElementById("dopPriceEnd").value=Number(dopPrice).toFixed(2);
    bnbPrice="<?php echo $bnbPrice;?>"; //scrap data from other website
    document.getElementById("bnbPrice").value=Number(bnbPrice);
    document.getElementById("apr").value=(dopPrice*34/1.09).toFixed(2);


    changeValue();
    changeValue2();
    combineDOPwithDOPBUSD();
    combineDOPwithBUSD();
}




var chartTest=null;
var chartTest2=null;
var chartTest3=null;
var chartTest4=null;
var chartTest5=null;
var chartTest6=null;
var tValues = [];
var yValues = [];
var compound=0;
var apr=0;
var totalGasFee=0;
var earningPerDay=0;
var startAmount=0;
var lastDay=0;
var xValuesMaxArr=[],yValuesMaxArr=[];
var dopPriceEnd;
function changeValue(){
    
    totalGasFee=document.getElementById("bnbPrice").value*document.getElementById("gasFee").value;
    document.getElementById("totalGasFee").value=totalGasFee.toFixed(2);
    lastDay=document.getElementById("lastDay").value;

     //auto calculate 
    apr=document.getElementById("apr").value/(365*100);
    startAmount=Number(document.getElementById("startAmount").value);
    
    //document.getElementById("dopPrice").value=apr*36500*2.662/82;
    document.getElementById("dopPrice").value=(apr*36500*1.09/34).toFixed(2);

    dopPriceEnd=document.getElementById("dopPriceEnd").value;
    dopPrice=document.getElementById("dopPrice").value;

    //this value need to reset every time
    xValuesMaxArr=[];
    yValuesMaxArr=[];
    for(compound=1;compound<=lastDay;compound++)
    {
        generateData("compound*apr-totalGas",0,lastDay,1);
        yValuesMaxArr.push(yValues[lastDay]);
        xValuesMaxArr.push(compound);
    }



    var x=0;
    var yMaxValue=0,yMaxValue2=1;
    var xMax=0,xMax2=0;
    // this loop will find the optimal solution
    while(x < yValuesMaxArr.length){ 
        //yValuesMaxArr[x] = yValuesMaxArr[x].toFixed(2); 
        if(yValuesMaxArr[x]>yMaxValue){
            yMaxValue=yValuesMaxArr[x];
            xMax=x+1;
        }/*
        if(yValuesMaxArr[x]>yMaxValue2){
            if((Math.abs(yValuesMaxArr[x]-yMaxValue2)/yMaxValue2)>0.03){
                
                    yMaxValue2=yValuesMaxArr[x];
                    xMax2=x+1;
                    console.log(yMaxValue2,xMax2);
                
            }
        }*/
        //document.getElementById("test").innerHTML=document.getElementById("test").innerHTML+" , "+yValuesMaxArr[x].toFixed(1);
        x++;
    }
    
    document.getElementById("bestCompound").value=yMaxValue.toFixed(2);
    document.getElementById("bestCompoundAt").value=xMax;
    //document.getElementById("test").innerHTML=yValuesMaxArr;

    compound=xMax;
    if(compound==0)compound=1; //when it need to compound every 0 it need to be 1
    
    createChart();
    createChart2();

}
function changeGraph(){
    
    //var g=document.getElementById("totalGasFee").value;//not less than c*p gas fee
    totalGasFee=document.getElementById("bnbPrice").value*document.getElementById("gasFee").value;
    lastDay=document.getElementById("lastDay").value;
    apr=document.getElementById("apr").value/(365*100); //apr per day
    startAmount=Number(document.getElementById("startAmount").value);
    compound=document.getElementById("bestCompoundAt").value;
    generateData("compound*apr-totalGas",0,lastDay,1);
    document.getElementById("bestCompound").value=yValues[lastDay].toFixed(2);
    createChart();
}
function generateData(value, i1, i2, step = 1) {
    //this value need to reset every time
    tValues = [];
    yValues = [];
      for (let t = i1; t <= i2; t += step) {
        if(t<compound){
            yValues.push(startAmount);
        }else{
            if(t%compound==0) //this will add value to z every  c days
            {
                earningPerDay=yValues[t-1]*apr;
                yValues.push(yValues[t-1]+eval("(compound*earningPerDay)-totalGasFee"));
            }else if(t==lastDay){ //this will add a little compound at the remain to the last value too
                earningPerDay=yValues[t-1]*apr;
                var cc=lastDay%compound;
                yValues.push(yValues[t-1]+eval("(cc*earningPerDay)-totalGasFee"));
            }else{ //when start will add the first one
                yValues.push(yValues[t-1]);
            }
        }
        tValues.push(t);
        
      }
}
function createChart(){
    generateData("c*s-g",0,lastDay,1);
    document.getElementById("profit").value=(yValues[lastDay]-yValues[0]).toFixed();
    if(chartTest!=null)
    {
        chartTest.destroy();
    }
    chartTest=new Chart("myChart", {
      type: "line",
      data: {
        labels: tValues,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValues
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "optimal solution",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmount").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: '$ earn'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Days'
                }
            }]
        }
      }

    });
}
function createChart2(){
    if(chartTest2!=null)
    {
        chartTest2.destroy();
    }
    chartTest2=new Chart("myChart2", {
      type: "line",
      data: {
        labels: xValuesMaxArr,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValuesMaxArr
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "return last amount of $ when compound every x days",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmount").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: 'total $ earn at lastDay'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Compound Every'
                }
            }]
        }
    }

    });
}








var startAmountDB=0;
var aprDB=0;
var compoundDB=0;
var yValuesMaxArrDB=[],xValuesMaxArrDB=[];
var tValuesDB=0,yValuesDB=0;
function changeValue2(){
    
    totalGasFee=document.getElementById("bnbPrice").value*document.getElementById("gasFee").value;
    document.getElementById("totalGasFee").value=totalGasFee.toFixed(2);
    lastDay=document.getElementById("lastDay").value;

     //auto calculate 
    aprDB=document.getElementById("aprDB").value/(365*100);
    startAmountDB=Number(document.getElementById("startAmountDB").value);
    
    //this value need to reset every time
    xValuesMaxArrDB=[];
    yValuesMaxArrDB=[];
    for(compoundDB=1;compoundDB<=lastDay;compoundDB++)
    {
        generateData2("compoundDB*aprDB-totalGas",0,lastDay,1);
        yValuesMaxArrDB.push(yValuesDB[lastDay]);
        xValuesMaxArrDB.push(compoundDB);
    }



    var x=0;
    var yMaxValue=0;
    var xMax=0;
    // this loop will find the optimal solution
    while(x < yValuesMaxArr.length){ 
        //yValuesMaxArr[x] = yValuesMaxArr[x].toFixed(2); 
        if(yValuesMaxArrDB[x]>yMaxValue){
            yMaxValue=yValuesMaxArrDB[x];
            xMax=x+1;
        }
        x++;
    }
    
    document.getElementById("bestCompoundDB").value=yMaxValue.toFixed(2);
    document.getElementById("bestCompoundAtDB").value=xMax;
    //document.getElementById("test").innerHTML=yValuesMaxArr;
    document.getElementById("bestCompoundAtDBDop").value=(xMax*startAmountDB*aprDB/dopPrice).toFixed(2);
    document.getElementById("bestCompoundAtDBDopBusd").value=((document.getElementById("bestCompoundAtDBDop").value)*dopPrice).toFixed(2);
    compoundDB=xMax;
    if(compoundDB==0)compoundDB=1; //when it need to compound every 0 it need to be 1
    
    //generateData2("c*s-g",0,lastDay,1);
    createChart3();
    createChart4();
    combineDOPwithDOPBUSD();

}
function changeGraph2(){
    
    //var g=document.getElementById("totalGasFee").value;//not less than c*p gas fee
    totalGasFee=document.getElementById("bnbPrice").value*document.getElementById("gasFee").value;
    lastDay=document.getElementById("lastDay").value;
    aprDB=document.getElementById("aprDB").value/(365*100); //apr per day
    startAmountDB=Number(document.getElementById("startAmountDB").value);
    compoundDB=document.getElementById("bestCompoundAtDB").value;
    document.getElementById("bestCompoundDB").value=yValuesMaxArrDB[compoundDB-1].toFixed(2);
    document.getElementById("bestCompoundAtDBDop").value=(compoundDB*startAmountDB*aprDB/dopPrice).toFixed(2);
    document.getElementById("bestCompoundAtDBDopBusd").value=((document.getElementById("bestCompoundAtDBDop").value)*dopPrice).toFixed(2);
    createChart3();
}
function generateData2(value, i1, i2, step = 1) {
    //this value need to reset every time
    tValuesDB = [];
    yValuesDB = [];
      for (let t = i1; t <= i2; t += step) {
        if(t<compoundDB){
            yValuesDB.push(startAmountDB);
        }else{
            if(t%compoundDB==0) //this will add value to z every  c days
            {
                earningPerDay=yValuesDB[t-1]*aprDB;
                yValuesDB.push(yValuesDB[t-1]+eval("(compoundDB*earningPerDay)-totalGasFee"));
            }else if(t==lastDay){ //this will add a little compoundDB at the remain to the last value too
                earningPerDay=yValuesDB[t-1]*aprDB;
                var cc=lastDay%compoundDB;
                yValuesDB.push(yValuesDB[t-1]+eval("(cc*earningPerDay)-totalGasFee"));
            }else{ //when start will add the first one
                yValuesDB.push(yValuesDB[t-1]);
            }
        }
        tValuesDB.push(t);
        
      }
      //console.log(yValuesDB[i2],tValuesDB[i2])
}
function createChart3(){
    generateData2("c*s-g",0,lastDay,1);
    document.getElementById("profitDB").value=((yValuesDB[lastDay]-yValuesDB[0])*dopPriceEnd/dopPrice).toFixed(2);
    if(chartTest3!=null)
    {
        chartTest3.destroy();
    }
    chartTest3=new Chart("myChart3", {
      type: "line",
      data: {
        labels: tValuesDB,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValuesDB
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "optimal solution",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmountDB").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: '$ earn'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Days'
                }
            }]
        }
      }

    });
}

function createChart4(){
    if(chartTest4!=null)
    {
        chartTest4.destroy();
    }
    chartTest4=new Chart("myChart4", {
      type: "line",
      data: {
        labels: xValuesMaxArrDB,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValuesMaxArrDB
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "return last amount of $ when compound every x days",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmountDB").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: 'total $ earn at lastDay'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Compound Every'
                }
            }]
        }
    }

    });
}





var startAmountDBwB=0;
var aprDBwB=0;
var compoundDBwB=0;
var yValuesMaxArrDBwB=[],xValuesMaxArrDBwB=[];
var tValuesDBwB=0,yValuesDBwB=0;
function combineDOPwithDOPBUSD(){//auto calculate 
    startAmountDB=Number(document.getElementById("startAmountDB").value);
    

    compoundDB=document.getElementById("bestCompoundAtDB").value;
    //if(compoundDBwB==0)compoundDBwB=1; //when it need to compound every 0 it need to be 1
    
    createChart5();
    

}
function generateData3(value, i1, i2, step = 1) {
    //this value need to reset every time
    tValuesDBwB = [];
    yValuesDBwB = [];
      for (let t = i1; t <= i2; t += step) {
        if(t<compoundDB){
            yValuesDBwB.push(startAmountDB);
        }else{
            earningPerDay=(startAmount*apr)+(yValuesDBwB[t-1]*aprDB);
            if(t%compoundDB==0) //this will add value to z every  c days
            {
                yValuesDBwB.push(yValuesDBwB[t-1]+(eval("(compoundDB*earningPerDay)-totalGasFee")));
            }else if(t==lastDay){ //this will add a little compoundDB at the remain to the last value too
                var cc=lastDay%compoundDB;
                yValuesDBwB.push(yValuesDBwB[t-1]+(eval("(cc*earningPerDay)-totalGasFee")));
            }else{ //when start will add the first one
                yValuesDBwB.push(yValuesDBwB[t-1]);
            }
        }
        tValuesDBwB.push(t);
        
      }
      //console.log(yValuesDB[i2],tValuesDB[i2])
}



function createChart5(){
    generateData3("c*s-g",0,lastDay,1);
    console.log(yValuesDBwB[365]-yValuesDBwB[0]-((yValues[365]-yValues[0])+(yValuesDB[365]-yValuesDB[0])));
    document.getElementById("bestCompoundDBwB").value= yValuesDBwB[lastDay].toFixed(2);
    document.getElementById("profitDBwB").value=((yValuesDBwB[lastDay]-yValuesDBwB[0])*dopPriceEnd/dopPrice).toFixed(2);
    if(chartTest5!=null)
    {
        chartTest5.destroy();
    }
    chartTest5=new Chart("myChart5", {
      type: "line",
      data: {
        labels: tValuesDBwB,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValuesDBwB
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "Combine 2 pools with DOP-BUSD LP",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmountDB").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: '$ get in everyday'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Days'
                }
            }]
        }
      }

    });
}

var startAmountDBb=0;
var aprDBwB=0;
var compoundDBb=0;
var yValuesMaxArrDBwB=[],xValuesMaxArrDBwB=[];
var tValuesDBb=0,yValuesDBb=0;
var pointToChart={chartTest6};
function combineDOPwithBUSD(){//auto calculate 
    startAmountDBb=Number(document.getElementById("startAmount").value);
    

    compoundDBb=document.getElementById("bestCompoundAtDB").value;
    //if(compoundDBwB==0)compoundDBwB=1; //when it need to compound every 0 it need to be 1

    createChart6(chartTest);
}
function generateData4(value, i1, i2, step = 1) {
    //this value need to reset every time
    tValuesDBb = [];
    yValuesDBb = [];
      for (let t = i1; t <= i2; t += step) {
        if(t<compoundDBb){
            yValuesDBb.push(startAmountDBb);
        }else{
            earningPerDay=(yValuesDBb[t-1]*apr)+(startAmountDB*aprDB);
            if(t%compoundDB==0) //this will add value to z every  c days
            {
                yValuesDBb.push(yValuesDBb[t-1]+(eval("(compoundDB*earningPerDay)-totalGasFee")));
            }else if(t==lastDay){ //this will add a little compoundDB at the remain to the last value too
                var cc=lastDay%compoundDBb;
                yValuesDBb.push(yValuesDBb[t-1]+(eval("(cc*earningPerDay)-totalGasFee")));
            }else{ //when start will add the first one
                yValuesDBb.push(yValuesDBb[t-1]);
            }
        }
        tValuesDBb.push(t);
        
      }
      //console.log(yValuesDB[i2],tValuesDB[i2])
}
function createChart6(){

    generateData4("c*s-g",0,lastDay,1);
    document.getElementById("bestCompoundDBb").value= yValuesDBb[lastDay].toFixed(2);
    document.getElementById("profitDBb").value=(yValuesDBb[lastDay]-yValuesDBb[0]).toFixed(2);
    if(chartTest6!=null)
    {
        chartTest6.destroy();
    }
    chartTest6=new Chart("myChart6", {
      type: "line",
      data: {
        labels: tValuesDBb,
        datasets: [{
          fill: false,
          pointRadius: 1,
          borderColor: "rgba(255,0,0,0.5)",
          data: yValuesDBb
        }]
      },    
      options: {
        legend: {display: false},
        title: {
          display: true,
          text: "Combine 2 pools with DOP-BUSD LP",
          fontSize: 16
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    suggestedMin: document.getElementById("startAmount").value    // minimum will be 0, unless there is a lower value.
                // OR //
                //beginAtZero: true   // minimum value will be 0.
                },
                scaleLabel: {
                    display: true,
                    labelString: '$ get in everyday'
                  }
            }],
            xAxes:[{
                display:true,
                scaleLabel:{
                    display:true,
                    labelString: 'Days'
                }
            }]
        }
      }

    });
}

</script>

<p id="demo"></p>

<!--<script async src="https://static.coinstats.app/widgets/coin-price-widget.js"></script>
<coin-stats-ticker-widget coin-id="dopple-finance" locale="en" currency="USD" rank-background="#FFA959" background="#1C1B1B" status-up-color="#74D492" status-down-color="#FE4747" rank-text-color="#1C1B1B" text-color="#FFFFFF" border-color="rgba(255,255,255,0.15)" type="large" height="182" width="350"></coin-stats-ticker-widget>-->
</body>
</html>


