  <?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PageController@index')->name("home-page");
Route::get('/about','PageController@about')->name("page.about");
Route::get('/contact','PageController@contact')->name("page.contact");

Route::get('/verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name("verifyEmailFirst");

Route::get('/download/success/{title}','PageController@successDownload')->name("download.success");
Route::get('/send/mail','PageController@mail')->name("page.mail");
Route::get('/worshippers/register','WorshippersController@index')->name('artist.register');
Route::get('/store','StoreController@index')->name("store-page");
Route::get('/store/books','StoreController@bookStore')->name("store.books");
Route::get('/store/books/{category}','storeController@category')->name("store-category-page");
Route::get('/store/cart','StoreController@cart')->name("store.cart");
Route::get('/store/checkout','StoreController@checkout')->name("store.checkout")->middleware('auth');
Route::post('/store/cart/add','CartController@store')->name("cart.store");
Route::post('/store/cart/delete/{id}','CartController@destroy')->name("cart.destroy");
Route::post('/store/cart/update/{id}','CartController@update')->name("cart.update");
Route::get('/store/{slug}','storeController@show')->name("store-show");
Route::get('/store/book/{slug}','storeController@showBook')->name("single.book.show");
// Route::get('store/cart/distroy', function () {
//   // Cart::destroy();
// });
Auth::routes();

Route::post('/login_custom',[
  'uses'=>"auth\LoginController@customLogin",
  'as'=>"login.custom"
]);

Route::get('/dashboard/redirect','UserController@redirectFromNav')->name("dashboard.redirect");

Route::group(['middleware'=>'auth'],function () {
  Route::get('/dashboard/profile/{view}',[
    'uses'=>'UserController@profileAdminView',
    'as'=>'admin.profile',
    'middleware'=>'roles',
    'roles'=>[]
  ]);
  Route::get('/dashboard',
  [
    'uses'=>'UserController@user_dash',
    'as'=>"user.dashboard",
    'middleware'=>'roles',
    'roles'=>['User','Admin']
  ]);

  Route::get('/admin/dashboard',[
    'uses'=>'UserController@admin_dash',
    'as'=>'admin.dashboard',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/orders',[
    'uses'=>'AdminController@orders',
    'as'=>'admin.orders',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/product',[
    'uses'=>'AdminController@productView',
    'as'=>'admin.dashboard.product',
    'middleware'=>'roles',
    'roles'=>['Admin'],
  ]);
  Route::get('/admin/dashboard/product/action/{action}/id/{id}',[
    'uses'=>'AdminController@productViewAction',
    'as'=>'product.action',
    'middleware'=>'roles',
    'roles'=>['Admin'],
  ]);

  Route::get('/admin/dashboard/blog',[
    'uses'=>'AdminController@blogView',
    'as'=>'admin.dashboard.blog',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/dashboard/blog/action/{action}/id/{id}',[
    'uses'=>'AdminController@blogViewAction',
    'as'=>'blog.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/dashboard/podcast',[
    'uses'=>'AdminController@podcastView',
    'as'=>'admin.dashboard.podcast',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/podcast/action/{action}/id/{id}',[
    'uses'=>'AdminController@podcastViewAction',
    'as'=>'podcast.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/audio',[
    'uses'=>'AdminController@audioView',
    'as'=>'admin.dashboard.audio',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/audio/action/{action}/id/{id}',[
    'uses'=>'AdminController@audioViewAction',
    'as'=>'audio.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);


  Route::get('/admin/dashboard/video',[
    'uses'=>'AdminController@videoView',
    'as'=>'admin.dashboard.video',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/dashboard/video/action/{action}/id/{id}',[
    'uses'=>'AdminController@videoViewAction',
    'as'=>'video.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/dashboard/haps',[
    'uses'=>'AdminController@hapsView',
    'as'=>'admin.dashboard.haps',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/dashboard/haps/action/{action}/id/{id}',[
    'uses'=>'AdminController@hapsViewAction',
    'as'=>'haps.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);


  Route::get('/admin/dashboard/books',[
    'uses'=>'AdminController@bookView',
    'as'=>'admin.dashboard.book',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/dashboard/books/action/{action}/id/{id}',[
    'uses'=>'AdminController@bookViewAction',
    'as'=>'book.action',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/admin/notification',[
    'uses'=>'AdminController@admin_notifcation',
    'as'=>'admin.notification',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::post('/admin/approval',[
    'uses'=>'AdminController@approve_author',
    'as'=>'author.approval',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);
  Route::get('/admin/blogposts',[
    'uses'=>'BlogController@allBlogPost',
    'as'=>'all.blog.post',
    'middleware'=>'roles',
    'roles'=>['Admin']
  ]);

  Route::get('/customer/dashboard',[
    'uses'=>'UserController@customer_dash',
    'as'=>'customer.dashboard',
    'middleware'=>'roles',
    'roles'=>['Customer']
  ]);

  Route::get('/dashboard/order/{msg?}',[
    'uses'=>'UserController@orders',
    'as'=>'order.display',
    'middleware'=>'roles',
    'roles'=>['Customer','User']
  ]);


});

Route::post('/payment', [
    'uses' => 'PaymentController@saveOrders',
    'as' => 'payment.store'
]);

Route::name('author.')->group(function () {
  Route::get('/author/contribute','AuthorController@contribute')->name("contribute");
  Route::post('/author/request','AuthorController@request')->name("request");
});

Route::get('/artist/pofile/{username}','MusicPostController@profile')->name("artist-profile");

Route::get('dashboard/audio',[
  'uses'=>'UserController@audioView',
  'as'=>'dashboard.audio',
  'middleware'=>'roles',
  'roles'=>['User']
]);
Route::get('/dashboard/audio/action/{action}/id/{id}',[
  'uses'=>'UserController@audioViewAction',
  'as'=>'u.audio.action',
  'middleware'=>'roles',
  'roles'=>['User']
]);
Route::get('dashboard/books',[
  'uses'=>'UserController@bookView',
  'as'=>'dashboard.books',
  'middleware'=>'roles',
  'roles'=>['User']
]);
Route::get('/dashboard/book/action/{action}/id/{id}',[
  'uses'=>'UserController@bookViewAction',
  'as'=>'u.book.action',
  'middleware'=>'roles',
  'roles'=>['User']
]);
Route::get('dashboard/blog',[
  'uses'=>'UserController@blogView',
  'as'=>'dashboard.blog',
  'middleware'=>'roles',
  'roles'=>['User']
]);
Route::get('/dashboard/blog/action/{action}/id/{id}',[
  'uses'=>'UserController@blogViewAction',
  'as'=>'u.blog.action',
  'middleware'=>'roles',
  'roles'=>['User']
]);

Route::patch('/product/update/{id}','StoreController@update')->name('storeProduct.update');
Route::patch('/blog/update/{id}','BlogController@update')->name('storeBlog.update');
Route::patch('/book/update/{id}','BooksController@update')->name('storeBook.update');
Route::patch('/podcast/update/{id}','PodcastController@update')->name('podcast.update');
Route::patch('/audio/update/{id}','MusicPostController@update')->name('audio.update');
Route::patch('/video/update/{id}','VideoPostController@update')->name('video.update');
Route::patch('/profile/update/{id}','UserController@update')->name('profile.update');



Route::post('/admin/dashboard/books','BooksController@storeBook')->name('admin-storeBook');

Route::get('/check','UserController@check')->name('check');

Route::post('/volunteer','VolunteerController@store')->name("volunteer.store");
Route::get('/artist/video','videoPostController@index')->name('video-page');
Route::get('/artist','MusicPostController@teams')->name("team-page");
Route::get('/artist/tracks','MusicPostController@allTracks')->name("fow.all.tracks");
Route::get('/artist/tracks{id}','MusicPostController@tracks')->name("fow.tracks");
Route::get('/artist/audio/{slug}','MusicPostController@show')->name("audio-show");
Route::get('/artist/video/{slug}','videoPostController@show')->name("video-show");
Route::any('/audio/search','MusicPostController@search')->name('audio.search');

Route::get('/haps','HapsController@index')->name("haps.index");

Route::get('/blog','BlogController@index')->name("blog.index");
Route::get('/blog/{slug}','BlogController@show')->name("blog.show");
Route::get('/blog/category/{category}','BlogController@category')->name("blog.category");
Route::get('/blog/tags/{tag}','BlogController@tag')->name("blog.tag");

Route::get('/admin/dashboard/{navigate}','AdminController@navigate')->name('navigate');
Route::get('/admin','auth\LoginController@ShowAdmin')->name("admin.show");
Route::get('/admin/dashboard/top','AdminController@index')->name('admin.index');
Route::post('/admin/dashboard/destroy','AdminController@destroy')->name('post.destroy');
Route::post('/admin','auth\LoginController@LoginAdmin')->name("admin.login");
Route::post('/admin/dashboard/audio','MusicPostController@storeAudio')->name('admin-storeAudio');
Route::post('/admin/dashboard/product','StoreController@storeProduct')->name('admin-storeProduct');
Route::post('/admin/dashboard/video','VideoPostController@storeVideo')->name('admin-storeVideo');
Route::post('/author/dashboard/blog','BlogController@create')->name('create.blog');
Route::post('/author/dashboard/epic','PodcastController@createEpic')->name('create.epic');
Route::post('/author/dashboard/podcast','PodcastController@CreatePodcast')->name('create.podcast');
Route::post('/admin/blog/approval','BlogController@approvalAction')->name('admin-blog-approval');
Route::post('/admin/haps','HapsController@create')->name('create.haps');
Route::post('/book/category','BooksController@addCategory')->name('category.book.add');



Route::get('/podcast','PodcastController@show')->name('podcast.all');
Route::get('/podcast/{epic_ids}/{slug}','PodcastController@details')->name('show.details');


Route::post('/newsletter','NewsLetterController@subscribe')->name('newsletter.subscribe');
//apikeys::d20fef8d2270b930a487173be9769961-us19
// list id::feac5b68e8

Route::post('/worshippers/register','WorshippersController@create')->name('worshipers.store');
