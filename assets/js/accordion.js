// takes a plugin Constructor function and creates a jQuery style widget
$.pluginMaker = function(plugin) {
  $.fn[plugin.prototype.name] = function(options) {
    
    var args = $.makeArray(arguments),
      after = args.slice(1);
    
    return this.each(function() {
      
      // see if we have an instance
      var instance = $.data(this, plugin.prototype.name);
      if (instance) {
        
        // call a method on the instance
        if (typeof options == "string") {
          instance[options].apply(instance, after);
        } else if (instance.update) {
          
          // call update on the instance
          instance.update.apply(instance, args);
        }
      } else {
        
        // create the plugin
        new plugin(this, options);
      }
    })
  };
};
  
// Creates a Namespace
Acc = {}
// A Basic Tab Constructor function
Acc.accord = function(el, options) {
  // if we don't have arguments, we're inheriting
  if (el) {
    this.init(el, options)
  }
}

// Extend the prototype
$.extend(Acc.accord.prototype, {
  // the name of the plugin, where it will be saved in jQuery.data
  name: "accordion",
  default_options : { firstactive:false },
  init:function(el,options){
    this.element = $(el);
    this.opts = $.extend( {}, this.default_options, options );
    // save this instance in jQuery data
    $.data(el, this.name, this);
    this.initialize();
  },
  initialize:function(){
    this.element.find(".accordion-title").bind("click",function(event){
      event.preventDefault();
      if (!$(this).next().is(':visible')) {
        $(this).closest("li").siblings().find(".accordion-title").removeClass("active");
        $(this).closest("li").siblings().find(".accordion-content").slideUp();
        $(this).next().slideDown();
        $(this).addClass('active');
      }else {
        $(this).next().find(".accordion-title.active").next().slideUp();
        $(this).next().find(".accordion-title.active").removeClass("active");
        $(this).next().slideUp();
        $(this).removeClass('active');
      }
    });
      
    if( this.opts.firstactive == true )
    {
      this.element.find("a").first().click();
    }
  },
  destroy:function(){
    $.removeData(this.element[0], this.name);
    this.element.find(".accordion-title").unbind("click");
    this.element = null;
  }
});
// make the accordion widget
$.pluginMaker(Acc.accord);