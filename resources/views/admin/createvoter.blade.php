@extends('admin.layouts.app')

@section('mainpanel')

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Voter</h4>
                    </div>
                    <div class="card-body">
                        <form ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Name</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Security</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >Address</label>
                                        <input type='text' class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Postal Code</label>
                                        <input type='text' class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Type</label>
                                        <select id="inputState" class="form-control">
                                            <option selected>Unknown</option>
                                            <option>NOMINEE</option>
                                            <option>SHAREHOLDER</option>
                                          </select>
                                    </div>
                                </div>

                            </div>

                            <br/><br/>

                            <button type="submit" class="btn btn-danger pull-right">Save &#38; Close</button>
                            <button type="submit" class="btn btn-warning pull-right">Save &#38; New</button>
                            
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>	
	
@endsection

@section('sidebar')
@include('admin/partials/sidebar')
@endsection