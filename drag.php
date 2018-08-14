<html>
<head>
	<style>
	.container
	{
	  white-space: nowrap;
		min-width:100%;
		width:1000%;
	}
	.list
	{
	  float:left;
		display: inline-block;
		width:200px;
	  min-height:100px;
		margin:5px;
	  background-color:yellow;
	}
	.card
	{
	  background-color:red;
	  margin:5px;
	}
	</style>
	<link href="jquery-ui.css" type="text/css" rel="stylesheet" media="screen,projection">
	<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="jquery-ui.min.js"></script>
	<script type="text/javascript" src="jquery.ui.touch-punch.min.js"></script>
</head>
<body>
  <a href="javascript:void(0);" onclick="createButton()">Create new button</a>
  <div class="container">
    <div class="list" id="list1">
      <div class="card">One
      </div>
      <div class="card">Two
      </div>
    </div>
    <div class="list">
      <div class="card">Three
      </div>
      <div class="card">Four
      </div>
    </div>
    <div class="list">
      <div class="card">Five
      </div>
    </div>
  </div>
  <script>
  function createButton()
  {
    var obj = "";
    obj += '<div class="card">Dynamic</div>';
    $("#list1").append(obj);
    $( ".card" ).draggable({
		appendTo :"body",
		helper:"clone",
		grid: [1, 1],
		revert:false,
		connectToSortable:".list",
		start: function(e, ui)
		 {
     		$(ui.helper).css("width","200px");
		 },
		 stop : function (e,ui)
		 {
		 }
	});
  }
  $( ".container" ).sortable({
		appendTo:"body",
		dropOnEmpty:"false",
		 update : function(e,ui)
		 {
		 }
	});
	$( ".card" ).draggable({
			appendTo :"body",
			helper:"clone",
			grid: [1, 1],
			revert:false,
			connectToSortable:".list",
			start: function(e, ui)
			 {
				$(ui.helper).css("width","200px");
			 },
			 stop : function (e,ui)
			 {
			 }
		});

	$( ".list" ).sortable({
		appendTo:"body",
		dropOnEmpty:"false",
		start : function (e,ui)
		 {
			ui.placeholder.css({visibility: 'visible', border : '1px solid black'});
			//alert();
		 },
		 receive : function(e,ui)
		 {
		 }
	});
  </script>
</body>
</html>