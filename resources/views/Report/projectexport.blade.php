<!DOCTYPE html>
<html>
<head>
  <title>Project Overview: {{ $data['title'] }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f4f4;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
    }

    p {
      color: #555;
      line-height: 1.5;
    }

    .info {
      margin-top: 20px;
      border-top: 1px solid #ccc;
      padding-top: 10px;
    }

    .info p {
      margin: 5px 0;
    }

    .label {
      font-weight: bold;
      width: 150px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Project Overview: {{ $data['title'] }}</h1>
    <div class="info">
      <p><span class="label">Project Manager:</span> {{ $data['project_manager'] }}</p>
      <p><span class="label">Team Lead:</span> {{ $data['team_lead'] }}</p>
      <p><span class="label">Total Tasks:</span> {{ $data['tot_tasks'] }}</p>
      <p><span class="label">Total Members:</span> {{ $data['tot_members'] }}</p>
      <p><span class="label">Total Commits:</span> {{ $data['tot_commits'] }}</p>
      <p><span class="label">Project ID:</span> {{ $data['project_id'] }}</p>
    </div>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis mi ac tincidunt aliquet. Mauris condimentum euismod nunc, vel posuere lectus finibus vel. Aenean faucibus tortor eget semper vulputate. Nullam maximus, risus eu egestas euismod, ligula mauris placerat lectus, in efficitur lacus ipsum ac velit.
    </p>
    <p>
      Sed consectetur velit id velit pellentesque, ut aliquet urna finibus. Nullam euismod augue non tellus ultrices, sit amet gravida neque gravida. Quisque blandit purus ut sem consequat, a lacinia mi vestibulum. Phasellus rhoncus elit nec malesuada tincidunt. Curabitur eleifend orci ut diam faucibus, in tincidunt felis convallis. Nullam lobortis tellus a lectus consectetur eleifend. 
    </p>
    <p>
      Morbi et arcu ac est cursus ultrices sed non elit. Proin non fermentum risus, et finibus orci. Duis nec rutrum dui, vitae eleifend ligula. Sed at varius dolor. Sed a lectus nec dolor egestas iaculis non in erat. Integer nec mi libero. In hac habitasse platea dictumst. Aenean sollicitudin libero id volutpat bibendum. 
    </p>
  </div>
</body>
</html>
