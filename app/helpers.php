<?php
 

 if (!function_exists('tenant')) {
    function tenant($key = null, $default = null)
    {
        $tenant = config('tenant');
 
        if ($key) {
            return data_get($tenant, $key, $default);
        }

        return $tenant;
    }
}
 
if (!function_exists('currentTenant')) {
    function currentTenant($key = null, $default = null)
    {
        $tenant = config('tenant');

        if ($key) {
            return data_get($tenant, $key, $default);
        }

        return $tenant;
    }
}

 if (!function_exists('site')) {
    function site($key = null, $default = null)
    {
        return tenant($key, $default);
    }
}

if (!function_exists('isActive')) {
    function isActive($route, $path = null)
    {
        if($path){
            return request()->route()->getName() == $route || request()->is($route) || request()->url() == $route || request()->is($path) || request()->is( $path . '/*');
        }
 
        return request()->route()->getName() == $route || request()->is($route) || request()->url() == $route ;
    }
}


if (!function_exists('icon')) {
    function icon($name, $size = 5, $class = '')
    {
        $html =  @str_replace(
            '<svg',
            '<svg class="size-' . $size . ' inline-block dark:text-gray-500 ' . $class . ' "',
            file_get_contents(public_path("assets/icons/tabler/$name.svg") ),
        );

        return new \Twig\Markup($html, 'UTF-8');
    }
}
 
if (!function_exists('t')) {
    function t($string)
    {
        return  __($string);
    }
}

if (!function_exists('settings')) {
    function settings($key)
    {
        return  config('settings.'.$key);
    }
}
 

if (!function_exists('primaryColorCode')) {
    function primaryColorCode()
    {
        return config('twind.theme.extend.colors.primary.500');
//  data_get(config('tailwindcss-colors'), data_get($theme, 'config.theme.primaryColor', 'blue'))
    }
}





if (!function_exists('user')) {
    function user($key = null)
    {
        $user = auth()->user();

        if ($key) {
            return data_get($user, $key, null);
        }

        return $user;
    }
}
 

if (!function_exists('generateKey')) {
    function generateKey($count = 16)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil(16 / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil(16 / 2));
        } else {
            throw new \Exception("No cryptographically secure random function available");
        }

        return substr(bin2hex($bytes), 0, $count);
    }
}

if (!function_exists('loadingIcon')) {
    function loadingIcon()
    {
        return '<div class="flex justify-center items-center p-3">
            <rasm:icon name="loader-3" class="animate-spin  text-gray-300 w-10 h-10" />
        </div>';
    }
}
 
if (!function_exists('slug')) {
    function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");
        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }
}
  
if (!function_exists('poseClass')) {
    function poseClass()
    {
        return '
             leading-8  
			 prose-figure:text-center
			 prose-figcaption:text-sm
	 
			 prose-pre:[direction:ltr]
             prose-pre:text-left
             prose-pre:bg-gray-200
             prose-pre:p-4
             prose-pre:text-xs
             prose-pre:leading-6
             prose-pre:rounded-lg
             prose-pre:overflow-x-scroll
             prose-pre:whitespace-pre-wrap
             prose-pre:max-h-[300px]
			 prose-figcaption:text-gray-500 prose-figcaption:-mt-6  prose-figure:mb-6
			 prose-hr:border-black/10 prose-hr:my-6 prose-hr:border-2
			 prose-blockquote:bg-primary-50 prose-blockquote:p-4 prose-blockquote:my-4 prose-blockquote:border-r-4 prose-blockquote:border-primary-500 prose-blockquote:ps-4 prose-blockquote:italic
			 prose-ol:list-decimal prose-ol:list-inside prose-ol:ps-5
			 prose-a:text-primary-500 prose-a:hover:text-primary-800 prose-a:underline
			 prose-ul:list-disc prose-ul:list-inside prose-ul:ps-5 prose-img:rounded-2xl xl:prose-p:text-base prose-p:my-1xx  
             prose-figure:mx-auto prose-img:mx-auto prose-img:my-8 
             xl:prose-h1:text-4xl prose-h1:text-xl prose-h1:font-semibold prose-h2:font-semibold 
             prose-h3:font-semibold  prose-h3:text-xl xl:prose-h2:text-2xl prose-h2:text-lg prose-headings:text-gray-800 prose-headings:my-2 prose-p:text-gray-700 xl:prose-p:leading-9
        ';
    }
}

if (!function_exists('editorStyle')) {
    function editorStyle()
    {
        return poseClass();
    }
}
  
if (!function_exists('themesPath')) {
    function themesPath($theme)
    {
        return public_path('themes/' . $theme);
    }
}

if (!function_exists('themeOptionList')) {
    function themeOptionList($theme)
    {
     
        // $path = resource_path('views/linkat-themes/' . $theme . '/options.json');
        $path = public_path($theme . '/options.json');
 
        if (\File::exists($path)) {
 
            $jsonFile = json_decode(file_get_contents($path), true);
            $themeOptions = $jsonFile ?: [];

            return $themeOptions;
        }

        return [];
    }
}

// if (!function_exists('option')) {
//     function option($key, $default = null)
//     {
//         return data_get(tenant(), 'linkinbio_theme_options.'.$key, $default);
//     }
// }

if (!function_exists('locale')) {
    function locale()
    {
        return app()->getLocale();
    }
}

if (!function_exists('production')) {
    function production()
    {
        return app()->environment('production');
    }
}

if (!function_exists('storage')) {
    function storage($path)
    {
        return Storage::url($path) ?? $path;
    }
}

if (!function_exists('siteStyle')) {
    function siteStyle()
    {
        $string = json_encode(config('twind', []));

        return new \Twig\Markup($string, 'UTF-8');
    }
}


if (!function_exists('price')) {
    function price($amount)
    {
        return ($amount / 100)  . ' ' . currency() ;
    }
}

if (!function_exists('currency')) {
    function currency($currency = null)
    {
        if($currency){
            return config('money.currencies.' . $currency . '.symbol');
        }

        return config('money.currencies.SAR.symbol');

    }
}

if (!function_exists('component')) {
    function component($component, $parms = [], $isLazy = false)
    {
        // lazy load
        if($isLazy || isset($parms['lazy']) && $parms['lazy']){

            $parms['component'] = $component;
      
            $html = \Livewire\Livewire::mount('storefront/Components/view', array_merge($parms, ['lazy' => true]), generateKey());
 
            return new \Twig\Markup($html, 'UTF-8');
        }

        $html = \Livewire\Livewire::mount($component, array_merge($parms, ['lazy' => $isLazy]), generateKey());

        return new \Twig\Markup($html, 'UTF-8');
    }
}

if (!function_exists('money')) {
    function money($amount, $long = false)
    {
        $html = \Blade::render('<x-admin::price amount="' .   $amount  . '" long="' . $long . '" />');
        return new \Twig\Markup($html, 'UTF-8');
    }
}