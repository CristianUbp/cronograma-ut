<% _.each(events, function(event){ %>
<div class="cal-row-fluid">
	<div class="cal-cell<%= event.days%> cal-offset<%= event.start_day %> day-highlight dh-<%= event['class'] %>" data-event-class="<%= event['class'] %>">
		<a href="<%= event.url ? event.url : 'javascript:void(0)' %>" data-event-id="<%= event.id %>" class="cal-event-week event<%= event.id %>"><%= event.horaini %>-<%= event.horafin %>-<%= event.class %>---<%= event.grupo %></a>
	</div>
</div>
<% }); %>