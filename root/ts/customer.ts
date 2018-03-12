'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Customer {


    export class MyCustomer {
        public el: any;

        constructor(
            private ajaxing: boolean = false,
            ){
            let self = this;

            $('#trigPageSelect').change( () => {
                const page = $('#trigPageSelect').val();
                location.href = '/admin/customer/'+page;
            });

        }

        public getHoge(): void {
        }

    }

}
export default Customer;
