<div id="sidebar">
	<!-- BEGIN MENUBAR-->
	<div id="menubar" class="menubar-inverse ">
		<div class="menubar-fixed-panel">
			<div>
				<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
					<i class="fa fa-bars"></i>
				</a>
			</div>
			<div class="expanded">
				<a href="../search/search.php">
					<span class="text-lg text-bold text-primary ">Vina Business System</span>
				</a>
			</div>
		</div>
		<div class="menubar-scroll-panel">

			<!-- BEGIN MAIN MENU -->
			<ul id="main-menu" class="gui-controls">

				<li>
					<a href="../leads/leads.php">
						<div class="gui-icon"><i class="fa fa-list-alt"></i></div>
						<span class="title">Leads</span>
					</a>
				</li>
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-list-alt"></i></div>
						<span class="title">Campaign</span>
					</a>
					<ul>
						<li>
							<a href="../campaign/campaign.php">
								<span class="title">Campaign</span>
							</a>
						</li>
						<li>
							<a href="../campaign/campaign_type.php">
								<span class="title">Campaign Type</span>
							</a>
						</li>
					</ul><!--end /submenu -->
				</li><!--end /menu-li -->
				
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-calendar"></i></div>
						<span class="title">Calendar</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../calendar/calendar.php">
								<span class="title">Calendar</span>
							</a>
						</li>
						<li>
							<a href="../calendar/calendar_events.php">
								<span class="title">Calendar Events</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->

				<li>
					<a href="../report/report.php">
						<div class="gui-icon"><i class="fa fa-file-excel-o" aria-hidden="true"></i></div>
						<span class="title">Report</span>
					</a>
				</li>
				

				
				<?php if($_SESSION['user_type'] == 2): ?>
				<li class="gui-folder">
					<a>
						<div class="gui-icon"><i class="fa fa-users"></i></div>
						<span class="title">Admin Modules</span>
					</a>
					<!--start submenu -->
					<ul>
						<li>
							<a href="../user/user.php">
								<span class="title">User Accounts</span>
							</a>
						</li>

					</ul><!--end /submenu -->
				</li><!--end /menu-li -->
				<?php endif; ?>
				<li>
					<a href="../logout.php">
						<div class="gui-icon"><i class="fa fa-sign-out"></i></div>
						<span class="title">Sign Out</span>
					</a>
				</li>
			</ul><!--end .main-menu -->
			<!-- END MAIN MENU -->

			<!-- <div class="menubar-foot-panel">
				<small class="no-linebreak hidden-folded">
					<span class="opacity-75">Copyright &copy; 2016</span> <strong><i class="fa fa-cube fa-fw"></i>Qubetek</strong>
				</small>
			</div> -->
		</div><!--end .menubar-scroll-panel-->
	</div><!--end #menubar-->
	<!-- END MENUBAR -->
</div>