const { registerBlockType } = wp.blocks;
const { Button } = wp.components;
const {RichText, MediaUpload, MediaUploadCheck, InnerBlocks} = wp.blockEditor;

class IconText {
    constructor() {
        this.title = 'Icon Text';
        this.description = 'Block to generate text with custom icon';
        this.icon = 'list-view';
        this.category = 'text';
        this.attributes = {
            content: {
                type: 'string',
                source: 'html',
                selector: 'p',
            },
            iconURL: {
                type: 'string',
                source: 'attribute',
                selector: 'img',
                attribute: 'src',
            },
            iconID: {
                type: 'string'
            }
        };
        this.edit = this.editFunction;
        this.save = this.saveFunction;
    }

    editFunction({ attributes, className, setAttributes }) {
        const { content, iconURL, iconID } = attributes;
        const onChangeContent = ( newContent ) => {
            setAttributes( { content: newContent} );
        };

        const onIconSelected = (media) => {
            setAttributes({
                iconURL: media.url,
                iconID: media.id,
            })
        } 
        
        return (
            <div className={className}>
                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={onIconSelected}
                        allowedTypes={ ['image'] }
                        value={ iconID }
                        render={ ( { open } ) => {
                            let result = iconURL ? <div onClick={open} className="has-image" style={{backgroundImage: 'url(' + iconURL + ')'}} height="50" width="50"></div> : (
                                <Button onClick={ open }>
                                    Select Icon
                                </Button>
                            );
                            
                            return result;
                        } }
                    />
                </MediaUploadCheck>

                <RichText
                    tagName="p"
                    className={ 'icon-text-content' }
                    value={ content }
                    onChange={onChangeContent}
                />
            </div>
        );
    }

    saveFunction({attributes, className}) {
        const { content } = attributes;
        
        return (
            <ul className={className}>
                <li>{content}</li>
            </ul>
        );
    }
}

class IconTextList {
    constructor() {
        this.title = 'Icon Text List';
        this.description = 'Block to generate list with icon text';
        this.icon = 'list-view';
        this.category = 'text';
        this.edit = this.editFunction;
        this.save = this.saveFunction;
    }

    editFunction({className}) {
        return (
            <div className={ className }>
                <InnerBlocks 
                    allowedBlocks={["sunset/icon-text"]}
                />
            </div>
        );
    }

    saveFunction() {
        return <div></div>;
    }
}

registerBlockType('sunset/icon-text', new IconText());
registerBlockType('sunset/icon-text-list', new IconTextList());
