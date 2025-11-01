<?php

return [
        "darkMode" => "class",
        "hash" => false,
        "theme" => [
            "extend" => [
                "colors" => [
                    "primary" => [
                        50 => "#EBEEFA",
                        100 => "#D7DDF4",
                        200 => "#B2BFEB",
                        300 => "#8A9DE0",
                        400 => "#667ED7",
                        500 => "#3D5CCC",
                        600 => "#2D48AA",
                        700 => "#21357D",
                        800 => "#162455",
                        900 => "#0B1128",
                        950 => "#050914",
                    ],
                 
                    "gray" => [  
                        50 => '#f9fafb',
                        100 => '#f3f4f6',
                        200 => '#e5e7eb',
                        300 => '#d1d5db',
                        400 => '#9ca3af',
                        500 => '#6b7280',
                        600 => '#4b5563',
                        700 => '#374151',
                        800 => '#1f2937',
                        900 => '#111827',
                        950 => '#030712',
                    ],
                 
                    "base" => [  
                        50 => '#f9fafb',
                        100 => '#f3f4f6',
                        200 => '#e5e7eb',
                        300 => '#d1d5db',
                        400 => '#9ca3af',
                        500 => '#6b7280',
                        600 => '#4b5563',
                        700 => '#374151',
                        800 => '#1f2937',
                        900 => '#111827',
                        950 => '#030712',
                    ],
                ],
                "fontFamily" => [
                    "sans" => "tsh, ibmps, sans-serif",
                    "logo" => "allabbad",
                    "tsh" => "tsh",
                    "camel" => "camel",
                ],
            ],
        ],
        "preflight" => [
            "@font-face" => [
                [
                    "fontFamily" => "tsh",
                    "src" => 'url(/assets/fonts/tsh.woff) format("woff")',
                    "fontStyle" => "thin",
                    "fontWeight" => 100,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "tsh",
                    "src" => 'url(/assets/fonts/tsh200.woff) format("woff")',
                    "fontStyle" => "normal",
                    "fontWeight" => 200,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "tsh",
                    "src" => 'url(/assets/fonts/tsh400.woff) format("woff")',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ],

                [
                    "fontFamily" => "almushaf",
                    "src" => 'url(/assets/fonts/almushaf.eot?#iefix), url(/assets/fonts/almushaf.woff) format("woff2") ',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ], [
                    "fontFamily" => "allabbad",
                    "src" => 'url(/assets/fonts/allabbad/font.woff) format("woff2") ',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "effra",
                    "src" => 'url(/assets/fonts/Effra_WArbc_Rg.woff) format("woff2")',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ], [
                    "fontFamily" => "ibmps",
                    "src" => 'url(/assets/fonts/ibmps/IBMPlexSansArabic-Regular.ttf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ], [
                    "fontFamily" => "ibmps",
                    "src" => 'url(/assets/fonts/ibmps/IBMPlexSansArabic-Thin.ttf)',
                    "fontStyle" => "thin",
                    "fontWeight" => 100,
                    "fontDisplay" => "auto",
                ], [
                    "fontFamily" => "ibmps",
                    "src" => 'url(/assets/fonts/ibmps/IBMPlexSansArabic-SemiBold.ttf)',
                    "fontStyle" => "semibold",
                    "fontWeight" => 500,
                    "fontDisplay" => "auto",
                ],
         
                [
                    "fontFamily" => "camel",
                    "src" => 'url(/assets/fonts/camelyear/TheYearofTheCamel-Light.otf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 200,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "camel",
                    "src" => 'url(/assets/fonts/camelyear/TheYearofTheCamel-Regular.otf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 400,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "camel",
                    "src" => 'url(/assets/fonts/camelyear/TheYearofTheCamel-Medium.otf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 500,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "camel",
                    "src" => 'url(/assets/fonts/camelyear/TheYearofTheCamel-Bold.otf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 700,
                    "fontDisplay" => "auto",
                ],
                [
                    "fontFamily" => "camel",
                    "src" => 'url(/assets/fonts/camelyear/TheYearofTheCamel-Thin.otf)',
                    "fontStyle" => "normal",
                    "fontWeight" => 100,
                    "fontDisplay" => "auto",
                ],

                // [
                //     "fontFamily" => "ibm-plex-sans-arabic",
                //     "src" => 'url(/assets/fonts/ibm-plex-sans-arabic-latin-400-normal.woff2) format("woff2")', 
                //     "unicode-range" => "U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;",
                //     "fontStyle" => "normal",
                //     "fontWeight" => 400,
                //     "fontDisplay" => "auto",
                // ],
            ],
            "body" => [
                "fontSize" => "1rem",
            ],
        ],
];