<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
<style type="text/css">
  div.container li {list-style-type: none; float: left; font-size: 15px; margin-left: 5px;}
  div.container li.active span{background: #373a3c !important; color: white;}
  div.container li span {padding: 5px 10px; background: #eee; color: #373a3c;}
  div.container li a {padding: 5px 10px; background: #eee; color: #373a3c;}
  div.container li a:hover {background: #373a3c !important; color: white; text-decoration: none;}
</style>
<div class="container">
<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>Sira</th>
      <th>Ad</th>
      <th>Mail</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$users->links()}}
</div>