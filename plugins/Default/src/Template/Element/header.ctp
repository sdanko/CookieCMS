<!--<div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
</div>-->

<div class="blog-masthead">
      <div class="container">
        <?php echo $this->Menus->menu('main', ['element' => 'Menus/navigation', 'navClass' => 'blog-nav', 
            'selected' => 'active', 'listed' => 'false', 'tagged' => 'false', 'linkClass' => 'blog-nav-item']); ?>
      </div>
</div>

 
  