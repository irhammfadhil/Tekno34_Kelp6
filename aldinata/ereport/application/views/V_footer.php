	</div><!-- /#right-panel -->
	<!-- Right Panel -->

	<script type="text/javascript">
		var BASE_URL  = '<?php echo base_url(); ?>';
	</script>
</body>

</html>


<script>
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>
