<div class="box">
  <span class="article__label text-white bg-info" style="">{{$category}}</span>
    <img 
      class="img-fluid rounded" 
      src="{{$banner}}"
      alt="{{$title}}"
      style="height: 250px !important; object-fit:cover; overflow:hidden;"
    >
    <h3>{{$title}}</h3>
    <div class="btn-wrap">
      <a href="/article/read/{{$slug}}" class="btn-buy">Baca</a>
    </div>
</div>