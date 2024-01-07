	</div>


	</div>
	</div>
	
	<br/>
	<div class="footer">
		<div class="container">
			<p class="text-muted">Powered by: <a href="#" target="_blank">PanTeam</a>
			<span class="pull-right">Copyright <?php echo date('Y'); ?>.</span>
			</p>
		</div>
	</div>

    <!-- jQuery -->
    <script src="<?php echo JAVASCRIPTS ?>jquery.min.js"></script>
	<script src="<?php echo JAVASCRIPTS ?>bootstrap.min.js"></script>
	
	<!-- Plugin JavaScript -->
	<script src="<?php echo FLEXIGRID ?>js/flexigrid.pack.js"></script>
	<script src="<?php echo DATATABLES ?>jquery.dataTables.min.js"></script>
	<script src="<?php echo DATETIMEPICKER?>js/moment.js"></script>
	<script src="<?php echo DATETIMEPICKER?>js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo CHOSEN ?>chosen.jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<!--<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>-->
	<!--<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>-->
	<script>
			<!-- GOOGLE Analytics Script -->
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-770268-22', 'auto');
			ga('send', 'pageview');
	</script>

</body>

</html>

<?php ob_end_flush(); ?>