<style type="text/css">

.pdfobject-container {
	width: 100%;
	height: 65vh;
	margin: 2em 0;
}
.pdfobject { border: solid 1px #666; }
#results { padding: 1rem; }
.hidden { display: none; }
.success { color: #4F8A10; background-color: #DFF2BF; }
.fail { color: #D8000C; background-color: #FFBABA; }
</style>


<div class="col-md-12">
	<div class="container">
		<h4>View PDF</h4>
		<p><a href="#" class="btn btn-info embed-link">Click here to view PDF.</a></p>
<div id="results" class="hidden"></div>
<div id="pdf"></div>
</div>
	</div>
</div>

<script>

document.querySelector(".embed-link").addEventListener("click", function (e){

	e.preventDefault();

	this.setAttribute("class", "hidden");

	var options = {
		pdfOpenParams: {
			pagemode: "thumbs",
			navpanes: 0,
			toolbar: 0,
			statusbar: 0,
			view: "FitV"
		}
	};

	var myPDF = PDFObject.embed("<?=base_url($mypdf);?>", "#pdf", options);

	var el = document.querySelector("#results");
	el.setAttribute("class", (myPDF) ? "success" : "fail");
	el.innerHTML = (myPDF) ? "PDFObject viewer!" : "the embed didn't work.";

});
</script>

<!-- analytics, unrelated to any example code presented on this page -->
