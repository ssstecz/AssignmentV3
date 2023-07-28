<div id = "app">
<nav class="navbar navbar-expand-lg fixed-top nav-bar">
<div class="container-fluid">
    <h1 class="navbar-brand">&emsp;PRODUCT ADD</h1>
    <div class="btn-group">
     <button type="submit" form="product_form" id="submit"
     style="background-color: green; color: white;border: none;
     padding: 10px 20px; border-radius: 5px;" name="submit">Save</button>
      <a :href="prodlistPage">
        <button type="button" style="background-color: grey; color: white; 
         border: none; padding: 10px 20px; border-radius: 5px;">CANCEL</button></a>                
    </div>
  </div>
</nav>
<br><br><br><br><br>
<div class="container-fluid">
  <!-- Form for data entry --> 
    <form method="POST" id="product_form" action="src/Include/Model/FormAction.php">
      <div class="flex-lg-6">
      <div id = "sku-field" class="form-control">  
      <label for="sku">SKU</label>    
        <input type="text" name="sku" id="sku" placeholder="Please enter SKU info, please don't use spaces, only letters/numbers">
        <strong><small id="sku-msg">Error Message</small></strong>
      </div>
      </div>
      <div class="flex-lg-6">
        <div class="form-control">
          <label for="name">NAME</label>
          <input type="text" name="name" id="name"
          placeholder="Please enter the Product Name, don't use only spaces or only special characters">
          <strong><small>Error Message</small></strong>
        </div>
      </div>
      <div class="flex-lg-6">
        <div class="form-control">
          <label for="price">PRICE</label>
          <input type="price" name="price" id="price"
            placeholder="Please enter the Product Price, use only numbers, no spaces and . as decimal separator">
            <strong><small>Error Message</small></strong>
        </div>
      </div>
      <div class="flex-lg-6">
        <div class="form-control">
          <label for="productType">Type Switcher
            <select v-model="selected" name="productType" id="productType">
              <option value='0'>DVD</option>
              <option value='1'>Book</option>
              <option value='2'>Furniture</option>
            </select>
            <div id="response"></div>      
        </div>
        <div v-if="selected == 0" class="form-control">
          <label for="size">SIZE</label>
          <input type="text" name="size" id="size"
          :placeholder="sizeText"
          @mouseover="sizeInfoOver"
          @mouseout="sizeInfoOut">
          <strong><small>Error Message</small></strong>
        </div>
        <div v-if="selected == 1" class="form-control">
          <label for="weight">WEIGHT</label>
          <input type="text" name="weight" id="weight"
          :placeholder="weightText"
          @mouseover="weightInfoOver"
          @mouseout="weightInfoOut">
          <strong><small>Error Message</small></strong>
        </div>
        <div v-if="selected == 2" class="form-control">
          <div>
            <label id="furtniture" >Furniture</label>
            <input type="text" name="height" id="height"
            :placeholder="heightText"
            @mouseover="heightInfoOver"
            @mouseout="heightInfoOut">
            <strong><small>Error Message</small></strong>
          </div>
          <div>
            <input type="text" name="width" id="width"
            :placeholder="widthText"
            @mouseover="widthInfoOver"
            @mouseout="widthInfoOut">
            <strong><small>Error Message</small></strong>
          </div>
          <div>
            <input type="text" name="length" id="length"
            :placeholder="lengthText"
            @mouseover="lengthInfoOver"
            @mouseout="lengthInfoOut">
            <strong><small>Error Message</small></strong>
          </div>
        </div>
      </div>
    </form>      
</div>
</div>