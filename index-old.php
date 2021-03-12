<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">

  <link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">

  <link rel="mask-icon" type="" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">

  <link rel="mask-icon" type="" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">

  <link rel="canonical" href="https://codepen.io/josheinstein/pen/oKzgw/">

  <link rel="stylesheet" href="https://twitter.github.com/bootstrap/assets/css/bootstrap.css">



  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


  <link rel="stylesheet" href="./css/master.css">
  <link id="themecss" rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" />
  <style class="INLINE_PEN_STYLESHEET_ID">
  #dragRoot {
    -moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
    border: 1px solid black;
    margin: 10px;
    padding: 10px;
    width: 300px;
    overflow-y: scroll;
    white-space: nowrap;
  }
  #dragRoot ul {
    display: block;
    margin: 0;
    padding: 0 0 0 20px;
  }
  #dragRoot li {
    display: block;
    margin: 2px;
    padding: 2px 2px 2px 0;
  }
  #dragRoot li [class*="node"] {
    display: inline-block;
  }
  #dragRoot li [class*="node"].hover {
    background-color: navy;
    color: white;
  }
  #dragRoot li .node-facility {
    color: navy;
    font-weight: bold;
  }
  #dragRoot li .node-cpe {
    color: black;
    cursor: pointer;
  }
  #dragRoot li li {
    border-left: 1px solid silver;
  }
  #dragRoot li li:before {
    color: silver;
    font-weight: 300;
    content: "— ";
  }

  </style>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeConsoleRunner-d8236034cc3508e70b0763f2575a8bb5850f9aea541206ce56704c013047d712.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRefreshCSS-bb9a2ba1f03f6147732cb3cd52ac86c6b24524aa87a05ed0b726f11e46d7e277.js"></script>
  <script src="https://cpwebassets.codepen.io/assets/editor/iframe/iframeRuntimeErrors-4f205f2c14e769b448bcf477de2938c681660d5038bc464e3700256713ebe261.js"></script>


  <title>Constant Technologies Task Arman Sargsyan</title>

</head>
<body>
  <div class="main-background">
    <div class="logo-bar">
      <img src="img/bck.png" width="100%" height="auto" alt="">
    </div>
    <div class="requestBlock">
      <button type="button" name="button" id="showCategories" onclick="getResponse()">Show</button>
    </div>
    <div id="responseBlock">
      <section style="padding: 10px;">
        <ul id="dragRoot" class="" >
        </ul>
      </section>
      <div id="editor-drag-cover" class="drag-cover"></div>
    </div>
  </div>

  <script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-157cd5b220a5c80d4ff8e0e70ac069bffd87a61252088146915e8726e5d9f147.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <script src="https://twitter.github.com/bootstrap/assets/js/bootstrap.js"></script>



  <script src="bootstrap/js/bootstrap.js" charset="utf-8"></script>
  <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  <script src="js/script.js" charset="utf-8"></script>
</body>
</html>
