		<div class="footer-wrap pd-20 mb-20 card-box">
				CopyRight &#169; 2020 OpenBioskop. All Rights Reserved.
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="/vendors/scripts/core.js"></script>
	<script src="/vendors/scripts/script.min.js"></script>
	<script src="/vendors/scripts/process.js"></script>
	<script src="/vendors/scripts/layout-settings.js"></script>
	<script src="/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="/vendors/scripts/dashboard3.js"></script>

	<script>
		function logout_app(){
			Swal.fire({
				title: 'Yakin ingin keluar?',
				// text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'YES'
			}).then((result) => {
			if (result.isConfirmed) {
				window.location = '?logout=true';
			}
			})
        }
	</script>
</body>
</html>