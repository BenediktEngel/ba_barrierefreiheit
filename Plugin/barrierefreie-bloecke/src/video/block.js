/**
 * BLOCK: barrierefreie-bloecke/Video
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 

const { BlockControls, InspectorControls, MediaPlaceholder, MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { Fragment } = wp.element;
const { Toolbar, PanelBody, ToggleControl, SelectControl, ToolbarButton, Spinner, Button ,PanelRow } = wp.components;
const {isBlobURL} = wp.blob;


registerBlockType( 'barrierefreie-bloecke/video', {
	title: __( 'Video - Barrierefrei' ), 
	icon: 'video-alt3', 
	category: 'common', 
	keywords: [
		__( 'Video' ),
		__( 'Barrierefreiheit' ),
	],
	description: __('Block für Videoinhalte mit der Möglichkeit für die Barrierefreiheit Untertitel auszugeben.'),
	attributes:{
		preload:{
			type: 'string',
			default: 'metadata'
		},
		autoplay:{
			type: 'boolean',
			default: false
		},
		repeat:{
			type: 'boolean',
			default: false
		},
		mute:{
			type: 'boolean',
			default: false
		},
		videoSource:{
			type: 'string'
		},
		captionSource:{
			type: 'string'
		},
		poster:{
			type: 'string',
			source: 'attribute',
			selector: 'video',
			attribute: 'poster'
		},
		url:{
			type: 'string',
			source: 'attribute',
			selector: 'video',
			attribute: 'src'
		},
		id:{
			type: 'number'
		},
		mime: {
			type: 'string'
		},
		subtitle:{
			type: 'string',
			source: 'attribute',
			selector: 'track',
			attribute:'src'
		},
		subtitleId:{
			type: 'number'
		},
		posterId:{
			type: 'number'
		}
	},
	edit: ( {attributes, setAttributes} ) => {
		const { autoplay, repeat, preload, mute, poster, url, id, mime, subtitle, subtitleId, posterId } = attributes;
		const onChangeAutoplay = (autoplay) =>{
			setAttributes({ autoplay })
		}
		const onChangeRepeat = (repeat) =>{
			setAttributes({ repeat })
		}
		const onChangePreload = (preload) =>{
			setAttributes({ preload })
		}
		const onChangeMute = (mute) =>{
			setAttributes({ mute })
		}
		const onSelectVideo = ({ url, id, mime }) =>{
			setAttributes({ url, id, mime })
		}
		const onError = (error) =>{
			wp.data.dispatch( 'core/notices' ).createNotice(
					'error', 
					error[2], 
					{isDismissible: true}
			);
		}
		return (
			<Fragment>
				{!url ?
					<Fragment>
						{/* Auswahl/Upload eines Videos zur Erfüllung von F200, F201 */}
						<MediaPlaceholder 
							icon = "format-aside"
							labels = {
								{title: __('Video'),
								instructions: __('Lade eine Videodatei hoch oder wähle eine aus deiner Mediathek.')}}
							onSelect={(video) => onSelectVideo(video)}
							onError={(error) => onError(error)}
							accept='video/*'
							allowedTypes={['video']}
						/>
						{!subtitle &&
							// Auswahl/Upload eines Untertitels zur Erfüllung von F202, F203 
							<MediaPlaceholder 
								icon = "format-aside"
								labels = {
									{title: __('Untertitel'),
									instructions: __('Lade eine Untertiteldatei hoch oder wähle eine aus deiner Mediathek.')}
								}
								onSelect={(subtitle) => setAttributes({subtitle: subtitle.url, subtitleId: subtitle.id})}
								onError={(error) => onError(error)}
								accept='text/vtt'
								allowedTypes={['text']}
							/>
						}
					</Fragment>
				:
					<Fragment>
						{!subtitle &&
						//  Auswahl/Upload eines Untertitels zur Erfüllung von F202, F203
							<MediaPlaceholder 
								icon = "format-aside"
								labels = {
									{title: __('Untertitel'),
									instructions: __('Lade eine Untertiteldatei hoch oder wähle eine aus deiner Mediathek.')}}
								onSelect={(subtitle) => setAttributes({subtitle: subtitle.url, subtitleId: subtitle.id})}
								onError={(error) => onError(error)}
								accept='text/vtt'
								allowedTypes={['text']}
							/>
						}
						{/* Ausgabe des Videos im Editor F204 */}
						<video controls autoplay={autoplay} loop={repeat} preload={preload} muted={mute} poster={poster} width="100%" src={url}>
   						{subtitle &&
						 		<track label={ __('Untertitel') } kind="subtitles" src={subtitle} default />
						 	}
						</video>
						{isBlobURL(url) || isBlobURL(subtitle) &&
							<Spinner />
						}
					</Fragment>
				}
				<InspectorControls>
					{url &&
						<PanelBody title={ __('Video-Einstellungen')}>
							{/* Einstellungen für F206, F208, F210, F212, F214 */}
							<ToggleControl
								label={ __('Autoplay') }
								checked={ autoplay }
								onChange={(v) => onChangeAutoplay(v)} 
							/>
							<ToggleControl
								label={ __('Schleife') }
								checked={ repeat }
								onChange={(v) => onChangeRepeat(v)} 
							/>
							<ToggleControl
								label={ __('Stumm') }
								checked={ mute }
								onChange={(v) => onChangeMute(v)} 
							/>
							<SelectControl
								label={ __('Vorladen') }
								value= { preload }
								options={ [
									{ label: __('Automatisch'), value: 'auto' },
									{ label: __('Metadaten'), value: 'metadata' },
									{ label: __('Keine'), value: 'none' },
								] }
								onChange={(v) => onChangePreload(v)}
							/>		
							<MediaUploadCheck>
								<PanelRow>{ __('Vorschaubild') }</PanelRow>
								<MediaUpload
									onSelect={(poster) => setAttributes({poster: poster.url, posterId: poster.id})}
									onError={(error) => onError(error)}
									allowedTypes={['image']}
									value = { posterId}
									render={({open})=>{
										return (
											<Button 
											isPrimary
											label={ __('Vorschaubild auswählen') }
											onClick={ open }
										>{ __('Auswählen') }</Button>
										)
									}}
								/>
							</MediaUploadCheck>	
						</PanelBody>
					}
				</InspectorControls>
				<BlockControls>
					{url &&
						<Toolbar>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(video) => onSelectVideo(video)}
									onError={(error) => onError(error)}
									allowedTypes={['video']}
									value = { id }
									render={({open})=>{
										return (
											<ToolbarButton 
											label={ __('Video ersetzen') }
											onClick={ open }
										>{ __('Video ersetzen') }</ToolbarButton>
										)
									}}
								/>
							</MediaUploadCheck>	
						</Toolbar>
					}
					{subtitle &&
						<Toolbar>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(subtitle) => setAttributes({subtitle: subtitle.url, subtitleId: subtitle.id})}
									onError={(error) => onError(error)}
									allowedTypes={['text']}
									value = { subtitleId}
									render={({open})=>{
										return (
											<ToolbarButton 
											label={ __('Untertitel ersetzen') }
											onClick={ open }
										>{ __('Untertitel ersetzen') }</ToolbarButton>
										)
									}}
								/>
							</MediaUploadCheck>	
						</Toolbar>
					}
				</BlockControls>
			</Fragment>	
		);
	},
	save: ( {attributes} ) => {
		const{ url, mute, poster, autoplay, repeat, preload, subtitle } = attributes; 
		return (
			<Fragment>
				{url &&
				// Ausgabe des Videos F204, F207, F209, F211. F213, F215
					<video controls autoplay={autoplay} loop={repeat} preload={preload} muted={mute} poster={poster} src={url}>
   					{subtitle &&
							<track label={ __('Untertitel') } kind="subtitles" src={subtitle} default />
				 		}
					</video>
				}
			</Fragment>
		);
	},
} );
