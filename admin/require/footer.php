

<footer class="main-footer">
     
      <div class="pull-right hidden-xs">
        <b>created by</b> IT Univ Pancasila
      </div>
       <strong>Copyright &copy; <?= date('Y'); ?></strong>
     
  </footer>


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/bower_components/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../assets/bower_components/chart.js/Chart.js"></script>
<!-- bootstrap datepicker -->
<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>

<!-- CK Editor -->
<script src="../assets/plugins/eqneditor/plugin.js"></script>
<script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- page script
<script>
$(document).ready(function(){
	load_data();
	function load_data(query)
	{
		$.ajax({
			url:"pengunjung/fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result').html(data);
			}
		});
		
	}
	
	load_data2();
	function load_data2(query)
	{
		$.ajax({
			url:"absensi/fetch.php",
			method:"post",
			data:{query:query},
			success:function(data)
			{
				$('#result2').html(data);
			}
		});
		
	}
	
	$('#search_text').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data(search);
		}
		else
		{
			load_data();			
		}
	});
	
	$('#search_text2').keyup(function(){
		var search = $(this).val();
		if(search != '')
		{
			load_data2(search);
		}
		else
		{
			load_data2();			
		}
	});
	

});
</script>
 -->
<!-- TABEL
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('.pilih th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" size="15" />' );
    } );
 
    // DataTable
    var table = $('#example1').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
 
<!-- /table---> 
<script>
  $(function () {
    $('#example1').DataTable()
	$('#example2').DataTable()
	$('#example3').DataTable()
	$('#example5').DataTable()	
    $('#example4').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
	
	  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
	 //Date picker2
    $('#datepicker2').datepicker({
      autoclose: true
    })
	 //Date picker3
    $('#datepicker3').datepicker({
      autoclose: true
    })
  
    CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
	CKEDITOR.replace('editor3');
	CKEDITOR.replace('editor4');
	CKEDITOR.replace('editor5');
	CKEDITOR.replace('editor6');	
	CKEDITOR.replace('editor7');	
	CKEDITOR.replace('editor8');			
  })
</script> 
 
</body>
</html> 