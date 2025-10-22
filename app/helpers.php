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
            <ui:icon name="loader-3" class="animate-spin  text-gray-300 size-12" />
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

if (!function_exists('option')) {
    function option($key =null, $default = null)
    {
        if($key){
            return data_get(config('themeOptions'), $key, $default);
        }

        return config('themeOptions');
    }
}

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
    function storage($path = null)
    {
        if($path){
            return Storage::url($path);
        }

        return $path;
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

if (!function_exists('renderBlock')) {
    function renderBlock($component, $parms = [], $isLazy = false)
    {
        $parms['component'] = $component;

        // lazy load
        if($isLazy || isset($parms['lazy']) && $parms['lazy']){
            $html = \Livewire\Livewire::mount('storefront.render-block', array_merge($parms, ['lazy' => true]), generateKey());
 
            return new \Twig\Markup($html, 'UTF-8');
        }

        $html = \Livewire\Livewire::mount('storefront.render-block', array_merge($parms, ['lazy' => $isLazy]), generateKey());
 
        return new \Twig\Markup($html, 'UTF-8');
    }
}

if (!function_exists('component')) {
    function component($component, $parms = [], $isLazy = false)
    {
        $parms['component'] = $component;

        // lazy load
        if($isLazy || isset($parms['lazy']) && $parms['lazy']){
            $html = \Livewire\Livewire::mount('storefront.component', array_merge($parms, ['lazy' => true]), generateKey());
 
            return new \Twig\Markup($html, 'UTF-8');
        }

        $html = \Livewire\Livewire::mount('storefront.component', array_merge($parms, ['lazy' => $isLazy]), generateKey());
 
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



/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param int $size Size in pixels, defaults to 64px [ 1 - 2048 ]
 * @param string $default_image_type Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param bool $force_default Force default image always. By default false.
 * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
 * @param bool $return_image True to return a complete IMG tag False for just the URL
 * @param array $html_tag_attributes Optional, additional key/value attributes to include in the IMG tag
 *
 * @return string containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
if (!function_exists('gravatar')) {
function gravatar(
    $email,
    $return_image = false,
    $size = 64,
    $default_image_type = 'mp',
    $force_default = false,
    $rating = 'g',
    $html_tag_attributes = []
) {
    // Prepare parameters.
    $params = [
        's' => htmlentities( $size ),
        'd' => htmlentities( $default_image_type ),
        'r' => htmlentities( $rating ),
    ];
    if ( $force_default ) {
        $params['f'] = 'y';
    }
 
    // Generate url.
    $base_url = 'https://www.gravatar.com/avatar';
    $hash = hash( 'sha256', strtolower( trim( $email ) ) );
    $query = http_build_query( $params );
    $url = sprintf( '%s/%s?%s', $base_url, $hash, $query );
 
    // Return image tag if necessary.
    if ( $return_image ) {
        $attributes = '';
        foreach ( $html_tag_attributes as $key => $value ) {
            $value = htmlentities( $value, ENT_QUOTES, 'UTF-8' );
            $attributes .= sprintf( '%s="%s" ', $key, $value );
        }
 
        return sprintf( '<img src="%s" %s/>', $url, $attributes );
    }
 
    return $url;
 
    }
}

if (!function_exists('hideEmail')) {    
    function hideEmail($email) {
        // Extract the username and domain
        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1];

        // Determine the number of characters to hide (e.g., half of the username)
        $chars_to_hide = floor(strlen($username) / 1.3);

        // Keep the first part of the username visible and replace the rest with stars
        $visible_part = substr($username, 0, strlen($username) - $chars_to_hide);
        $hidden_part = str_repeat('*', $chars_to_hide);

        // Combine the parts to form the hidden email
        return $visible_part . $hidden_part . '@' . $domain;
    }   
}