<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2" id="vote-index">
	<div class="row">
		<div class="col-xs-12 code-form">
			<div class="form-group">
				<p class="lead" data-i18n="vote.code_form.enter">Entra el Código :</p>
				<p class="text-danger code-error"></p>
				<input type="text" class="form-control input-lg" name="code" id="input-code" value="85Z3ELKRND">
				<button type="submit" class="btn btn-primary btn-lg btn-block" data-i18n="vote.code_form.submit" >Enviar</button>
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 vote-form">
			<h1 class="page-header"><span data-i18n="vote.vote_form.title">Tu opinion de :</span> <span id="vote-placename"></span></h1>
			<form role="form" method="POST" action="<?= URL ?>vote/rate">
				<input type="hidden" name="vote_id_item" id="vote-id-item" value="">
				<div class="form-group">

					<div class="row">
						<div class="col-sm-3">
							<input type="hidden" id="vote-code" name="vote_code" value="">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="vote_email">Email <span class="star">*</span> </label><small data-i18n="vote.vote_form.not_show">(nobody will see this)</small>
					<div class="row">
						<div class="col-sm-10 col-md-9 col-lg-7">
							<input type="email" class="form-control" id="vote-email" name="vote_email">
							<div class="error"></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="vote_grade_personal"><span  data-i18n="vote.vote_form.personal">Personal</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_personal" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote_grade_cleanliness"><span data-i18n="vote.vote_form.cleanliness">Limpieza</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_cleanliness" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote_grade_confort"><span data-i18n="vote.vote_form.confort">Confort</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_confort" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote_grade_location"><span data-i18n="vote.vote_form.location">Ubicación</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_location" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote_grade_services"><span data-i18n="vote.vote_form.services">Instalaciones y servicios</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_services" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote_grade_pqratio"><span data-i18n="vote.vote_form.pqratio">Relación calidad - precio</span> <span class="star">*</span></label>
					<div>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="1"> 1
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="2"> 2
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="3"> 3
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="4"> 4
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="5"> 5
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="6"> 6
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="7"> 7
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="8"> 8
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="9"> 9
						</label>
						<label class="radio-inline">
							<input type="radio" name="vote_grade_pqratio" value="10"> 10
						</label>
					</div>
					<div class="error"></div>
				</div>
				<div class="form-group">
					<label for="vote-name" data-i18n="vote.vote_form.nombre">Nombre</label>
					<div class="row">
						<div class="col-sm-10 col-md-9 col-lg-7">
							<input type="text" class="form-control" id="vote-name" name="vote-text">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="vote-text" data-i18n="vote.vote_form.comment">Commentario</label>
					<div class="row">
						<div class="col-sm-10 col-md-9 col-lg-7">
							<textarea id="vote-text" name="vote-text" class="form-control" rows="6"></textarea>				
						</div>
					</div>
				</div>
				<div class="checkbox">
					<label>
					  <input type="checkbox" name="vote-newsletter" > <span data-i18n="vote.vote_form.newsletter">Quiero recibir el boletín mensual de rutadeloscolonos.cl</span>
					</label>
				</div>
				<button type="submit" class="btn btn-default"  data-i18n="vote.vote_form.submit">Enviar</button>
			</form>
		</div>
	</div>
</div>
