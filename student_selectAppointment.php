<!DOCTYPE html>
<html>   
    <head>
        
        <title>Student Select Appt.</title>
    
        <!-- Meta tags to describe the page -->
        <meta charset="UTF-8" />
        <meta name="description" content="Select Appointment Page for Students" />
        <meta name="author" content="Edgar Courtemanch, Benjamin Decre, Emily McGovern, Taylor Webb, Emily Yu" />
        
        <link rel="stylesheet" type="text/css" href="student.css" />
        
    </head>
    
    <body>
        
        <div class="header">
            <h1>Advising</h1>
            <h2>Student Select Appt.</h2>
        </div>
        
        <div class="content">
            
			
			<h3>Filter</h3>
            <form action="student_selectAppointment.html" method="post">
				<p>
					Advisor		
					<select id="advisor">
						<option value="smith">Bob Smith</option>
						<option value="jones">Bob Jones</option>
					</select>
				</p>
				<p>Date			<input type="date" id="date" /></p>
				<p>Time			<input type="time" id="time" /></p>
				<p>Location 	<input type="text" id="location" /></p>
				<input type="submit" />
			</form>
			
			<h3>Appointments</h3>
			<table>
				<tr>
					<th>Advisor</th>
					<th>Date</th>
					<th>Time</th>
					<th>Location</th>
					<th>Description???</th>
					<th>Select</th>
				</tr>
			
				<!-- example row for css creation purposes -->
				<tr>
					<td>bob smith</td>
					<td>12/2/2016</td>
					<td>2:49</td>
					<td>Library RLC</td>
					<td>Honors College Students Only</td>
					<td><a href="student_selectAppointment.html">Select</a></td>
				</tr>
			</table>
        </div>
    </body>
</html>