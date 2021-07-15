# API-for-product-site
## Damazlle Task
### The required steps to setup the project:
* install Laravel
 ```
composer global require laravel/installer
 ```
* download code or clone it
```
 git clone https://github.com/MhdTa/API-for-product-site-Damazlle.git
```
* set database parameter in .env file
* run migrations
 ```php
 php artisan migrate
 ```
 * run the app
 ```
 php artisan serve
 ```
 ## Signin
After entering the required information, it will be verified and authenticated
 ```php
    public function store(Request $request)
    {
        $this->validate($request, [
           
            'username' => 'required|max:255',
            'tel' => 'required|max:255',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'tel' => $request->tel,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('tel', 'password'));

        return response($request,202);
    }
    
  ```
## Log in
You can also login by entering phone number and password
 ```php
    public function store(Request $request)
    {
        //validate the data
        $this->validate($request, [
            'tel' => 'required',
            'password' => 'required',
        ]);

        
        if (!auth()->attempt($request->only('tel', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return response()->setStatusCode(202,'user login successfully!');
    }
 ```
## products page
after login you can show all products and add a new product
 ```php
    public function index()
    {
        //get the products
        $products = Product::latest()->paginate(5);
        return response($products);
    }

   //add a new product
    public function store(Request $request,Product $product)
    {
       
        $this->validate($request, [
            'productName' => 'required',
            'productPrice' => 'required',
        ]);

        
        $product->productName =  $request->get('productName');
        $product->initialPrice =  $request->get('productPrice');
        $product->isSold =  0;
        $product->user_id =  $request->user()->id;

        //store in db
        $product->save();


        return response()->setStatusCode(202,'The product is created successfully!');
    }
  ```
## show a product
if you click on any product you can show the details:
* Seller name
* Product Publication Date
* initial Price of product
* All bids of product
* product status (sold or not sold)
* and you can add an offer if you are logged-in
![Screenshot](images/6.JPG)
### if you are the owner of the project you can:
* edit the name or price of product
* delete the product
* sell the product if you are satisfied by the highest bid

![Screenshot](images/7.JPG)
## Search for a product offered by other users by part of its name
 using laravel-searchable repo link:
 https://github.com/spatie/laravel-searchable
 only un sold products shown
  ```php
  public function search( Request $request)
    {
 
        $searchterm = $request->input('query');
 
        $searchResults = (new Search())
                    ->registerModel(Product::class, 'productName')
                    ->perform($searchterm);
              
         return response( compact('searchResults', 'searchterm'));
    }
  ```
 ## Notes:
 * If you are not logged-in you can only show the products
  ```php
     public function __construct()
    {
        //just loged in user can do these functions
        $this->middleware(['auth'])->only(['store', 'destroy','update','sell']);
    }
   ```
 ## DataBase:
 * User Table:
   ![Screenshot](images/12.JPG)
 * Product Table:
   ![Screenshot](images/10.JPG) 
 * BidOffer Table:
   ![Screenshot](images/11.JPG) 
   # Some Tests in postman:
   * get product
     ![Screenshot](postman1.JPG) 
   * Search for a prduct:
     ![Screenshot](postman2.JPG)  
     #
     # Note:
     
