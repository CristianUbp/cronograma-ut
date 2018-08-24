

<div id="cal-day-box">
	<div class="row-fluid cal-row-head">
		<div class="span1 col-xs-1 cal-cell"><%= cal.locale.time %></div>
		<div class="span11 col-xs-11 cal-cell"><%= cal.locale.events %></div>
	</div>
	<% if(all_day.length) {%>
		<div class="row-fluid clearfix cal-day-hour">
			<div class="span1 col-xs-1"><b><%= cal.locale.all_day %></b></div>
			<div class="span11 col-xs-11">
				<% _.each(all_day, function(event){ %>
					<div class="day-highlight dh-<%= event.class %>">
						<%= event.materia %>
					</div>
				<% }); %>
			</div>
		</div>
	<% }; %>



<script type="text/javascript" >
            function recargar(parametro){
                var url = "auth.php?ide="+parametro;
                $('#').load(url);
            }
     </script>


	<div id="cal-day-panel" class="clearfix">
		<% _.each(by_hour, function(event){ %>
			<div class="pull-left day-event day-highlight dh-<%= event.class %>" style="margin-top: <%= (event.top * 0 - 0.5)  %>px; height: <%= (event.lines * 60) %>px">
<form action="modificar.php?ide=" target="_blank" method="GET">
					<input type="text" name="ide"  value="<%= event.id %>" hidden=""> 
				
				
				<button  class="cal-hours evento" data-toggle='modal' data-target='#mod_evento' onclick='recargar("<?php echo $ide; ?>");'>  <%= event.start_hour %> - <%= event.end_hour %></button> <p><%= event.descr %> - <%= event.class %></p> 
				</form>
				<p> <%= event.materia %> - <%= event.profesor %></p>       <p>  <%= event.grupo %>  </p>
			</div>
			
		<% }); %>

		<div id="cal-day-panel-hour">
			<% for(i = 0; i < hours; i++){ %>
				<div class="cal-day-hour">
					<% for(l = 0; l < in_hour; l++){ %>
						<div class="row-fluid cal-day-hour-part">
							<div class="span1 col-xs-1"><b><%= cal._hour(i, l) %></b></div>
							<div class="span11 col-xs-11"></div>
						</div>
				<% }; %>
				</div>
			<% }; %>

		</div>
	</div>
</div>


    

    