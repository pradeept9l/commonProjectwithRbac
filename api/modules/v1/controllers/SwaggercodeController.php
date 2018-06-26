<?php
use api\modules\v1\definitions;

// Swagger Code For login

 /**
    * @SWG\Post(path="/v1/user/login",
    *     tags={"Member"},
    *     summary="User login.",
    *	produces = {"application/json"},
    *	consumes = {"application/x-www-form-urlencoded"},
    * @SWG\Parameter(
    *        in = "header",
    *        name = "deviceId",
    *        description = "Device Id",
    *        default = "PK1234567AN",
    *        required = true,
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "formData",
    *        name = "username",
    *        description = "Username",
    *        required = true,
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "formData",
    *        name = "password",
    *        description = "Password",
    *        required = true,
    *        type = "string"
    *     ),
    *     @SWG\Response(
    *         response = 200,
    *         description = "Login Successfully",
    *     ),
    * )
    */
// swagger code for Register


    /**
     * @SWG\Post(path="/v1/site/register",
     *     tags={"Member"},
     *     summary="User Registration.",
     *	produces = {"application/json"},
     *	consumes = {"application/x-www-form-urlencoded"},
     * @SWG\Parameter(
     *        in = "header",
     *        name = "deviceId",
     *        description = "deviceId",
     *        default = "PK123456", 
     *        required = true,
     *        type = "string"
     *     ),
     * @SWG\Parameter(
     *        in = "formData",
     *        name = "User[fname]",
     *        description = "First name",
     *        required = true,
     *        type = "string"
     *     ),
     * @SWG\Parameter(
     *        in = "formData",
     *        name = "User[lname]",
     *        description = "Last name",
     *        required = true,
     *        type = "string"
     *     ),
     * @SWG\Parameter(
     *        in = "formData",
     *        name = "User[email]",
     *        description = "Email id",
     *        required = true,
     *        type = "string"
     *     ),
     * @SWG\Parameter(
     *        in = "formData",
     *        name = "User[phone]",
     *        description = "User phone number",
     *        required = true,
     *        type = "integer"
     *     ),
     * @SWG\Parameter(
     *        in = "formData",
     *        name = "User[password]",
     *        description = "Password",
     *        required = true,
     *        type = "string"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "User Register Successful",
     *     ),
     * )
     */

/**
    * @SWG\Post(path="/v1/products/list",
    *     tags={"Vehical"},
    *     summary="Product listing.",
    *	produces = {"application/json"},
    *	consumes = {"application/x-www-form-urlencoded"},
    * @SWG\Parameter(
    *        in = "header",
    *        name = "auth_token",
    *        description = "User Auth key",
    *        default = "Y_iW8atrXe9-x5m3L1_C7xz98ShPlMSQ",
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "header",
    *        name = "deviceId",
    *        description = "Device Id",
    *        default = "PK1234567AN",
    *        required = true,
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "formData",
    *        name = "catId",
    *        description = "Category id",
    *        type = "integer"
    *     ),
    * @SWG\Parameter(
    *        in = "formData",
    *        name = "subCatId",
    *        description = "Sub Category Id",
    *        type = "integer"
    *     ),
    * @SWG\Parameter(
    *        in = "formData",
    *        name = "page",
    *        description = "Page number",
    *        type = "integer"
    *     ),
    *     @SWG\Response(
    *         response = 200,
    *         description = "Product Listing",
    *     ),
    * )
    */

// Swagger code for Product Details


 /**
    * @SWG\Get(path="/v1/products/details?id={id}",
    *     tags={"Vehical"},
    *     summary="Product listing.",
    *	produces = {"application/json"},
    *	consumes = {"application/x-www-form-urlencoded"},
    * @SWG\Parameter(
    *        in = "header",
    *        name = "auth_token",
    *        description = "User Auth key",
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "header",
    *        name = "deviceId",
    *        description = "Device Id",
    *        default = "PK1234567AN",
    *        required = true,
    *        type = "string"
    *     ),
    * @SWG\Parameter(
    *        in = "path",
    *        name = "id",
    *        description = "Product id",
    *        type = "integer"
    *     ),
   *     @SWG\Response(
    *         response = 200,
    *         description = "Product Details",
    *     ),
    * )
    */




?>