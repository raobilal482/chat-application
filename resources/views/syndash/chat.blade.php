@extends('syndash.layouts.app')
@section('chat')
					<div class="chat-wrapper">
						<div class="chat-sidebar">
							<div class="chat-sidebar-header">
								<div class="d-flex align-items-center">
									<div class="chat-user-online">
										<img src="{{asset('assets')}}/images/avatars/avatar-1.png" width="45" height="45" class="rounded-circle" alt="" />
									</div>
									<div class="flex-grow-1 ms-2">
										<p class="mb-0">{{ Auth::user()->name }}</p>
										<p class="mb-0 text-success">Online</p>
										<p id="senderid" hidden>{{ Auth::user()->id }}</p>
									</div>
								</div>
							</div>
							<div class="chat-sidebar-content">
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="pills-Chats">
										
										<div class="chat-list">
											<div class="list-group list-group-flush">
												@foreach ($users as $user)
												@if ($user['name'] == Auth::user()->name)
													@continue
												@endif
												<a id="{{$user->id}}"   href="javascript:;" class="list-group-item receiverid">
													<div   class="d-flex ">
														<div class="chat-user-online">
															<img src="{{asset('assets')}}/images/avatars/avatar-6.png" width="42" height="42" class="rounded-circle" alt="" />
														</div>
														
														<div class="flex-grow-1 ms-2 " >
															<h6  class="mb-0 chat-title " data-id="{{ucfirst($user->id)}}" id="rname">{{ucfirst($user->name)}}</h6>
															
															<p class="mb-0 chat-msg" id="lastmessage">Have you finished the draft...</p>
														</div>
														<div class="chat-time">11/6/2023</div>
													</div>
												</a>
												@endforeach
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="chat-header d-flex align-items-center bg-light">
							<div class="chat-toggle-btn"><i class='bx bx-menu-alt-left'></i>
							</div>
							<div>
								<h4 id="receivername" class="mb-0 mt-1 font-weight-bold pt-2"></h4>
								<p id="onlinetoast" class="mt-0 text-success" style="display: none">Active Now</p>
							</div>
						</div>
						<div class="chat-content" id="messages-list">

						</div>
						<div class="chat-footer d-flex align-items-center">
							<div class="flex-grow-1 pe-2">
								<div class="input-group w-100">	<span class="input-group-text"><i class='bx bx-smile'></i></span>
									<form id="chatform">
										@csrf
										<input id="message" type="text" class="form-control w-100" placeholder="Type a message">
								</div>
							</div>
							<div class="chat-footer-menu"> 
								
								<a href="javascript:;" id="chatbtn"><i class='bx bxs-chat'></i></a>
							</form>
							</div>
						</div>
						<!--start chat overlay-->
						<div class="overlay chat-toggle-btn-mobile"></div>
						<!--end chat overlay-->
					</div>			
@endsection