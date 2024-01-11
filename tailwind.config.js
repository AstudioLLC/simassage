module.exports = {
    theme: {
        fontSize: {
            'xss': '.55rem',
            'xsss': '.70rem',
            'xs': '.75rem',
            'sm': '.875rem',
            'tiny': '.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '4rem',
            '7xl': '5rem',
            '10xl': '10rem',
            'custom-xl': '1.3125rem'
        },
        boxShadow: {
            'over': '0 3px 5px 0 #80808061',
            'skew': '6px 3px 4px 1px #80808061',
        },
        important: true,
        zIndex: {
            '0': 0,
            '10': 10,
            '20': 20,
            '25': 25,
            '30': 30,
            '40': 40,
            '50': 50,
            '75': 75,
            '100': 100,
            '999': 9999,
        },
        offset: true,
        colors: {
            transparent: '#ffffff00',
            green: '#42A500',
            gray: {
                lighter: '#FAFAFA',
                light: '#f4f4f4',
                custom: '#eeeeee',
                default: '#E9E9E9',
                darker: '#484848',
                dark: '#a0a0a0'
            },
            blue: {
                default: '#015291',
                dark: '#00345b',
                light: '#005291',
                lighter: '#F7F8FC',
                mail: '#365FF5',
                fb: '#4267B2'
            },
            pink: {
                default: '#df20ef',
                custom: '#DF203F',
            },
            red: '#fe0000',
            yellow: {
                default: '#ffa800',
                custom: '#FFA900',
                dark: '#E89200',
            },
            white: '#ffffff',
            black: {
                default: '#333333',
                light: '#313131',
                lighter: '#242424',
            },
            fontBlack: '#111111'
        },
        borderWidth: {
            default: '1px',
            0: '0',
            2: '2px',
            3: '3px',
            4: '4px',
            6: '6px',
            8: '8px',
        },
        screens: {
            xs: '420px',
            xss: '500px',
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1200px',
            xxl: '1440px',
        },
        inset: {
            'none': 'unset',
            '50': '50%',
            '20': '20%',
            '10': '10%',
            '5': '5%',
            '3': '3%',
            '0': '0'
        },
        extend: {
            outline: {
                pink: '#df20ef',
            },
            skew: {
                '20-': '-20deg',
                '20': '20deg',
                '60': '60deg',
            },
            gap: {
                '1': '0.25rem',
                '2': '0.5rem',
            },
            top: {
                100: '100%'
            },
            inset: {
                100: '100%',
            },
            maxWidth: {
                '1/2': '50%',
                'menu': '270px',

            },
            width: {
                'fit-content': 'fit-content',
                '4/10': '40%',
                '3/10': '30%',
                '6/10': '60%',
                '9/10': '90%',
                '85/10': '85%',
                '15/10': '15%',
                'fit': 'fit-content',
                '128': '32rem',
                'category_leftbar_m': '80px',
                'category_leftbar_m_right': '100wv',
            },
            height: {
                '1/2': '50%',
                'auto': 'auto!Important',
                '500px': '500px',
                'mmenu': 'calc(100vh - 125px);'
            },
        },
        container: {
            center: true,
            width: {
                xs: '360px'

            },
            padding: {
                default: '1rem',
                xs: '0'
            }
        },
        divideWidth: {
            default: '1px',
            '0': '0',
            '2': '2px',
            '3': '3px',
            '4': '4px',
            '6': '6px',
            '8': '8px',
        }

    },
    variants: {
        borderColor: ['hover', 'focus', 'checked', 'focus-within'],
        backgroundColor: ['responsive', 'hover', 'focus', 'checked', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'checked', 'group-hover'],
        borderWidth: ['responsive', 'last', 'hover', 'focus'],
        display: ['responsive', 'hover', 'focus'],
        pointerEvents: ['responsive', 'hover', 'focus'],
        width: ['responsive'],

    },

    plugins: [require('@tailwindcss/custom-forms'),],
}
