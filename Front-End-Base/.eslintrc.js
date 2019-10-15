/* eslint-disable */
module.exports = {
  root: true,
  env: {
    browser: true,
  },
  'extends': 'vuetify',
  rules: {
    'arrow-parens': 0,
    // allow async-await
    'generator-star-spacing': 0,
    // allow debugger during development
    'no-debugger': process.env.NODE_ENV === 'production' ? 2 : 0,
    'no-console': 0,

    'no-undef': 0,
    

    "skipBlankLines": 0,
    "skipBlankLines": 0,
    "ignoreComments": 0,


    // //'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
    //'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
  },
  parserOptions: {
    parser: 'babel-eslint',
  },

}
